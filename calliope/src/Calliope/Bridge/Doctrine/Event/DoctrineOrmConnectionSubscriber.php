<?php
namespace Calliope\Bridge\Doctrine\Event;

use Calliope\Bridge\Doctrine\Connection\DoctrineOrmConnection;
use Doctrine\Common\Persistence\ObjectManager;
use Clio\Component\Metadata\Schema\ClassMetadata;
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
			$this->doUpdateSchemaAttributeInfo($em, $classMetadata);
			$this->doUpdateSchemaTagInfo($em, $classMetadata);
		}
	}

	/**
	 * doUpdateSchemaInfo 
	 * 
	 * @param ObjectManager $em 
	 * @param ClassMetadata $classMetadata 
	 * @access protected
	 * @return void
	 */
	protected function doUpdateSchemaAttributeInfo(ObjectManager $em, ClassMetadata $classMetadata)
	{
		$attributeField = 'attributes';

		if($classMetadata->hasMapping('attribute_map_aware')) {
			$doctrineClassMetadata = $em->getClassMetadata($classMetadata->getName());
			//
			$attributeMapping = $doctrineClassMetadata->getAssociationMapping($attributeField);
			$attributeClass = $attributeMapping['targetEntity'];

			$classMetadata->getMapping('attribute_map_aware')->setAttributeClass($attributeClass);
		}
	}

	/**
	 * doUpdateSchemaTagInfo 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doUpdateSchemaTagInfo(ObjectManager $em, ClassMetadata $classMetadata)
	{
		$tagField = 'tags';

		if($classMetadata->hasMapping('tag_set_aware')) {
			$doctrineClassMetadata = $em->getClassMetadata($classMetadata->getName());
			$mapping = $doctrineClassMetadata->getAssociationMapping($tagField);
			$tagClass = $mapping['targetEntity'];

			$classMetadata->getMapping('tag_set_aware')->setTagClass($tagClass);
		}
	}
}

