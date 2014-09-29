<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;

/**
 * DoctrineReferenceHandler 
 *   Serialize as Model
 *   Deserialize from Id 
 *   If you would like to serialize to id only, then use DoctrineIdReferenceHandler instead.
 * 
 *   type: DoctrineReference<Model\Class, "em.name">
 *  
 * 
 *   object<User> -> serialize -> serializer->serialize($user);
 *   {"user": 1} -> deserialize -> $userRepository->findOneBy(array('id' => 1));
 * 
 * @uses SubscribingHandlerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineReferenceHandler implements SubscribingHandlerInterface
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
        $collectionTypes = array('DoctrineReference');

        foreach ($collectionTypes as $type) {
            foreach ($formats as $format) {
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

	public function deserializeValue(VisitorInterface $visitor, $value, array $type, $context)
	{
		$connection = $this->getConnectionFromType($type);
		$class = $this->getEntityClassFromType($type);

		$manager = $this->getDoctrineManager($connection);

		$repository = $manager->getRepository($class);

		$metadata = $manager->getClassMetadata($class);
		if(!is_array($value)) {
			$fields = $metadata->getIdentifier();
			$field = reset($fields);

			$value = array($field => $value);
		} else {
			$value = array_intersect_key($value, array_flip($metadata->getIdentifier()));
		}

		$entity = $repository->findOneBy(
			$value
		);
		return $entity;
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
}

