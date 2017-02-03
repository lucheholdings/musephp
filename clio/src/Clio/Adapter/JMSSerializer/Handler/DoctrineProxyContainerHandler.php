<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use Clio\Component\Util\Container\Container;
use Clio\Bridge\Doctrine\Container\ProxyContainer;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Handler\ArrayCollectionHandler;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\Context;

use JMS\Serializer\Handler\SubscribingHandlerInterface;

/**
 * DoctrineProxyContainerHandler 
 * 
 * @uses ArrayCollectionHandler
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineProxyContainerHandler implements SubscribingHandlerInterface 
{
	static protected $containerTypes = array('DoctrineProxyContainer', 'Clio\Bridge\Doctrine\Container\ProxyContainer');

	/**
	 * getSubscribingMethods 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	public static function getSubscribingMethods()
	{
        $methods = array();
        $formats = array('json', 'xml', 'yml');
        $containerTypes = static::$containerTypes;

        foreach ($containerTypes as $type) {
            foreach ($formats as $format) {
                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'serializeContainer',
                );

                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'deserializeContainer',
                );
            }
        }

        return $methods;
	}


    /**
     * serializeContainer 
     * 
     * @param VisitorInterface $visitor 
     * @param Collection $container 
     * @param array $type 
     * @param Context $context 
     * @access public
     * @return void
     */
    public function serializeContainer(VisitorInterface $visitor, ProxyContainer $container, array $type, Context $context)
    {
        // We change the base type, and pass through possible parameters.
        return $visitor->visitArray($this->containerToArray($container), array('name' => 'array'), $context);
    }

    /**
     * deserializeContainer 
     * 
     * @param VisitorInterface $visitor 
     * @param mixed $data 
     * @param array $type 
     * @param Context $context 
     * @access public
     * @return void
     */
    public function deserializeContainer(VisitorInterface $visitor, $data, array $type, Context $context)
    {
		$type['name'] = 'array';

		return $this->decorateCollection(new ArrayCollection($visitor->visitArray($data, $type, $context))); 
    }

	/**
	 * decorateCollection 
	 * 
	 * @param Collection $container 
	 * @access public
	 * @return void
	 */
	protected function decorateCollection(Collection $collection)
	{
		return new ProxyContainer($collection);
	}

	/**
	 * containerToArray 
	 * 
	 * @param Collection $container 
	 * @access protected
	 * @return void
	 */
	protected function containerToArray(Container $container)
	{
		return $container->getRaw();
	}
}

