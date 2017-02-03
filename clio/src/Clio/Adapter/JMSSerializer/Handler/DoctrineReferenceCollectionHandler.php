<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;

class DoctrineReferenceCollectionHandler implements SubscribingHandlerInterface 
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
        $collectionTypes = array('DoctrineReferenceCollection');

        foreach ($collectionTypes as $type) {
            foreach ($formats as $format) {
                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'serializeValue',
                );

                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'deserializeValue',
                );
            }
        }

        return $methods;
    }

	private $doctrine;

	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function serializeValue(VisitorInterface $visitor, $value, array $type, $context)
	{
		$arrayType = array(
			'name' => 'array',
			'params' => array(
				0 => array(
					'name' => $this->getElementSerializationType(),
					'params' => array(
						0 => array('name' => $this->getEntityClassFromType($type)),
						1 => array('name' => $this->getConnectionFromType($type))
					),
				),
			),
		);
		return $visitor->visitArray($value, $arrayType, $context);
	}

	public function deserializeValue(VisitorInterface $visitor, $value, array $type, $context)
	{
		$arrayType = array(
			'name' => 'array',
			'params' => array(
				0 => array(
					'name' => $this->getElementSerializationType(),
					'params' => array(
						0 => array('name' => $this->getEntityClassFromType($type)),
						1 => array('name' => $this->getConnectionFromType($type))
					),
				),
			),
		);

		return $visitor->visitArray($value, $arrayType, $context);
	}

	protected function getConnectionFromType(array $type)
	{
		if(isset($type['params'][1])) {
			return $type['params'][1]['name'];
		} 
		return 'default';
	}

	protected function getEntityClassFromType(array $type)
	{
		return $type['params'][0]['name'];
	}

	public function getDoctrineManager($manager)
	{
		return $this->doctrine->getManager($manager);
	}

	protected function getElementSerializationType()
	{
		return 'DoctrineReference';
	}
}

