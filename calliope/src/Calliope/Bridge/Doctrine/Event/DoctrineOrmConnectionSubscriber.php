<?php
namespace Calliope\Bridge\Doctrine\Event;

use Calliope\Bridge\Doctrine\Connection\DoctrineOrmConnection;
use Doctrine\Common\Persistence\ObjectManager;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;
/**
 * DoctrineOrmConnectionSubscriber 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineOrmConnectionSubscriber   
{
	/**
	 * onConnect
	 * 
	 * @param mixed $event 
	 * @access public
	 * @return void
	 */
	public function onConnect($event)
	{
		if($event->getConnection() instanceof DoctrineOrmConnection) {

			$classMetadata = $event->getManager()->getClassMetadata();
			$em = $event->getConnection()->getObjectManager();
			// 
			$this->doUpdateSchemeAttributeInfo($em, $classMetadata);
			$this->doUpdateSchemeTagInfo($em, $classMetadata);
		}
	}

	/**
	 * doUpdateSchemeInfo 
	 * 
	 * @param ObjectManager $em 
	 * @param ClassMetadata $classMetadata 
	 * @access protected
	 * @return void
	 */
	protected function doUpdateSchemeAttributeInfo(ObjectManager $em, ClassMetadata $classMetadata)
	{
		$attributeField = 'attributes';

		if($classMetadata->hasMapping('attribute_container_aware')) {
			$doctrineClassMetadata = $em->getClassMetadata($classMetadata->getName());
			//
			$attributeMapping = $doctrineClassMetadata->getAssociationMapping($attributeField);
			$attributeClass = $attributeMapping['targetEntity'];

			$classMetadata->getMapping('attribute_container_aware')->setAttributeClass($attributeClass);
		}
	}

	/**
	 * doUpdateSchemeTagInfo 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doUpdateSchemeTagInfo(ObjectManager $em, ClassMetadata $classMetadata)
	{
		$tagField = 'tags';

		if($classMetadata->hasMapping('tag_container_aware')) {
			$doctrineClassMetadata = $em->getClassMetadata($classMetadata->getName());
			$mapping = $doctrineClassMetadata->getAssociationMapping($tagField);
			$tagClass = $mapping['targetEntity'];

			$classMetadata->getMapping('tag_container_aware')->setTagClass($tagClass);
		}
	}
}

