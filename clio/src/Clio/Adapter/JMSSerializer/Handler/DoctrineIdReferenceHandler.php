<?php
namespace Clio\Adapter\JMSSerializer\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\VisitorInterface;

/**
 * DoctrineIdReferenceHandler 
 *   Serialize as Id(s)
 * 
 *   type: DoctrineIdReference<Model\Class, "em.name">
 *  
 * 
 *   object<User> -> serialize -> serializer->serialize($user->getId());
 *   {"user": 1} -> deserialize -> $userRepository->findOneBy(array('id' => 1));
 * 
 * @uses SubscribingHandlerInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineIdReferenceHandler extends DoctrineReferenceHandler
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
        $collectionTypes = array('DoctrineIdReference');

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

	public function serializeValue(VisitorInterface $visitor, $value, array $type, $context)
	{
		if(is_object($value)) {
			$connection = $this->getConnectionFromType($type);
			$class = $this->getEntityClassFromType($type);

			$manager = $this->getDoctrineManager($connection);

			$metadata = $manager->getClassMetadata($class);
			$repository = $manager->getRepository($class);

			$value = $metadata->getIdentifierValues($value);

			if(is_array($value) && (1 == count($value))) {
				$value = reset($value);
			}
		}

		return $value;
	}
}

