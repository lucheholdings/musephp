<?php
namespace Calliope\Bridge\Doctrine\Filter;

// todo: condition namespace is not defined.
use Calliope\Framework\Core\Filter\Condition\ConnectCondition;
use Calliope\Bridge\Doctrine\Connection\DoctrineOrmConnection;
use Doctrine\Common\Persistence\ObjectManager;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;

/**
 * DoctrineOrmFilter 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineOrmFilter
{
	/**
	 * onConnect 
	 * 
	 * @param ConnectCondition $condition 
	 * @access public
	 * @return void
	 */
	public function onConnect(ConnectCondition $condition)
	{
		if($condition->getConnection() instanceof DoctrineOrmConnection) {
			$classMetadata = $condition->getConnection()->getConnectFrom()->getClassMetadata();
			$em = $condition->getConnection()->getObjectManager();

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

