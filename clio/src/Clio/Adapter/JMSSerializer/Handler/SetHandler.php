<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;

use Clio\Component\Util\Container\Set;

class SetHandler extends ContainerHandler 
{
	/**
	 * initContainerFactory 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initContainerFactory()
	{
		$this->containerFactory = new ComponentFactory('Clio\Component\Util\Container\Set\Set');
	}

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
        $collectionTypes = array('Set', 'Clio\Component\Util\Container\Set', 'Clio\Component\Util\Container\Set\Set');

        foreach ($collectionTypes as $type) {
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

    public function serializeContainer(VisitorInterface $visitor, $collection, array $type, $context)
	{
		if(!$collection instanceof Set) {
			throw new \InvalidArgumentException(sprintf('You specified "%s" as serialization type, but data is "%s".', $type['name'], is_object($collection) ? get_class($collection) : gettype($collection)));
		} 

		// Convert data to KeyValue Array
		return $visitor->visitArray(
			$collection->toArray(),
			array(
				'name' => 'array'
			),
			$context
		);
	}

    public function deserializeContainer(VisitorInterface $visitor, $data, array $type, $context)
	{
		$container = $container->getContainerFactory()->create();

		$container->setRaw($visitor->visitArray($data, 'array', $context));

		return $container;
	}
}

