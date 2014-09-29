<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\Context;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Handler\SubscribingHandlerInterface;


/**
 * ContainerHandler 
 * 
 * @uses SubscribingHandlerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ContainerHandler implements SubscribingHandlerInterface 
{
	/**
	 * containerFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $containerFactory;

    /**
     * serializeContainer 
     * 
     * @param VisitorInterface $visitor 
     * @param mixed $collection 
     * @param array $type 
     * @param mixed $context 
     * @access public
     * @return void
     */
    public function serializeContainer(VisitorInterface $visitor, $collection, array $type, $context)
    {
		if(!$collection instanceof ContainerInterface) {
			throw new \InvalidArgumentException(sprintf('You specified "%s" as serialization type, but data is "%s".', $type['name'], is_object($collection) ? get_class($collection) : gettype($collection)));
		} 

		// Convert data to KeyValue Array
		return $visitor->visitArray(
			$collection->getRaw(),
			array(
				'name' => 'array'
			),
			$context
		);
    }

    /**
     * deserializeContainer 
     * 
     * @param VisitorInterface $visitor 
     * @param mixed $data 
     * @param array $type 
     * @param mixed $context 
     * @access public
     * @return void
     */
    public function deserializeContainer(VisitorInterface $visitor, $data, array $type, Context $context)
    {
		$container = $this->getContainerFactory()->create();
	
		$container->setRaw($visitor->visitArray($data, 'array', $context));

		return $container;
    }

	/**
	 * initContainerFactory 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function initContainerFactory();
    
    /**
     * Get containerFactory.
     *
     * @access public
     * @return containerFactory
     */
    public function getContainerFactory()
    {
		if(!$this->containerFactory) {
			$this->initContainerFactory();
			if(!$this->containerFactory) {
				throw new Exception('Failed to initialize CntainerFactory.');
			}
		}

        return $this->containerFactory;
    }
    
    /**
     * Set containerFactory.
     *
     * @access public
     * @param containerFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setContainerFactory($containerFactory)
    {
        $this->containerFactory = $containerFactory;
        return $this;
    }
}

