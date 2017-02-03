<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\Context;

use Clio\Component\Util\Container\Map;

class MapHandler extends ContainerHandler 
{
	/**
	 * initContainerFactory 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initContainerFactory()
	{
		$this->containerFactory = new ComponentFactory('Clio\Component\Util\Container\Map\Map');
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
        $collectionTypes = array('Map', 'Clio\Component\Util\Container\Map', 'Clio\Component\Util\Container\Map\Map');

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
		if(!$collection instanceof Map) {
			throw new \InvalidArgumentException(sprintf('You specified "%s" as serialization type, but data is "%s".', $type['name'], is_object($collection) ? get_class($collection) : gettype($collection)));
		} 

		// Convert data to KeyValue Array
		return $visitor->visitArray(
			$collection->getKeyValueArray(),
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
		$innerType = clone $type;
		$innerType['name'] = array();

		foreach($data as $key => $value) {
			if(!is_array($value)) {
				$data[$key] = array('key' => $key, 'value' => $value);
			} else if(!isset($value['key'])) {
				$data[$key]['key'] = $key;
			}

			if(!isset($value['value'])) {
				unset($data[$key]);
			}
		}
		$container = $container->getContainerFactory()->create($visitor->visitArray($data, $innerType, $context));

		return $container;
	}
}

