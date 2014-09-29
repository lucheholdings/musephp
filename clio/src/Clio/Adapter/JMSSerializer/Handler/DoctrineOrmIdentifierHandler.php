<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;

/**
 * DoctrineOrmIdentifierHandler 
 * 
 * @uses SubscribingHandlerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineOrmIdentifierHandler implements SubscribingHandlerInterface
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
        $collectionTypes = array('DoctrineOrmIdentifier');

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
		if(is_object($value)) {
			$connection = $this->getConnectionFromType($type);
			$class = $this->getEntityClassFromType($type);

			$manager = $this->getDoctrineManager($connection);

			$metadata = $manager->getClassMetadata($class);
			$repository = $manager->getRepository($class);

			$value = $metadata->getIdentifierValues($value);

			if(1 == count($value)) {
				$value = reset($value);
			}
		}
		return $value;
	}

	public function deserializeValue(VisitorInterface $visitor, $value, array $type, $context)
	{
		$connection = $this->getConnectionFromType($type);
		$class = $this->getEntityClassFromType($type);

		$manager = $this->getDoctrineManager($connection);

		$repository = $manager->getRepository($class);

		if(!is_array($value)) {
			$metadata = $manager->getClassMetadata($class);
			$fields = $metadata->getIdentifier();
			$field = reset($fields);

			$value = array($field => $value);
		}

		$entity = $repository->findOneBy(
			$value
		);
		return $entity;
	}

	protected function getConnectionFromType(array $type)
	{
		if(isset($type['params'][1])) {
			return $type['params'][1];
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
}

