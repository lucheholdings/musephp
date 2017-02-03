<?php
namespace Clio\Adapter\JMSSerializer\Handler;

class PceBehaviorAttributeHandler implements SubscribingHandlerInterface 
{
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
        $collectionTypes = array('Attribute');

        foreach ($collectionTypes as $type) {
            foreach ($formats as $format) {
                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'serializeObject',
                );

                //$methods[] = array(
                //    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                //    'type' => $type,
                //    'format' => $format,
                //    'method' => 'deserializeObject',
                //);
            }
        }

        return $methods;
    }

    /**
     * serializeObject 
     * 
     * @param VisitorInterface $visitor 
     * @param KeyValueInterface $attribute 
     * @param array $type 
     * @access public
     * @return void
     */
    public function serializeObject(VisitorInterface $visitor, KeyValueInterface $attribute, array $type, Context $context)
    {
		if(!isset($type['params']) || count($type['params']) == 0) {
			// guess type
			$type = gettype($attribute->getValue());
		} else {
			$type = $type['params'][0];
		}
		return $visitor->getNavigator()->accept($attribute->getValue(), array('name' => $type, 'params' => array()), $context);
    }

    /**
     * deserializeObject 
     * 
     * @param VisitorInterface $visitor 
     * @param mixed $data 
     * @param array $type 
     * @access public
     * @return void
     */
    public function deserializeObject(VisitorInterface $visitor, $data, array $type)
    {
		if(null === $data) {
			return null;
		}
		
		throw new \Exception('KeyValue can only deserialize via KeyValueCollection');
    }
}

