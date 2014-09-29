<?php
namespace Calliope\Bridge\Doctrine\Metadata\Mapping;

use Doctrine\Common\Persistence\Mapping\ClassMetadata as DoctrineClassMetadata;

class DoctrineMapping 
{
	private $doctrineClassMapping;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(DoctrineClassMapping $classMapping)
	{
		$this->doctrineClassMapping = $classMapping;
	}
    
    /**
     * Get doctrineClassMapping.
     *
     * @access public
     * @return doctrineClassMapping
     */
    public function getDoctrineClassMapping()
    {
        return $this->doctrineClassMapping;
    }
    
    /**
     * Set doctrineClassMapping.
     *
     * @access public
     * @param doctrineClassMapping the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDoctrineClassMapping($doctrineClassMapping)
    {
        $this->doctrineClassMapping = $doctrineClassMapping;
        return $this;
    }

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->getDoctrineClassMapping()->getName();
    }

    /**
     * getIdentifier 
     * 
     * @access public
     * @return void
     */
    public function getIdentifier()
    {
        return $this->getDoctrineClassMapping()->getIdentifier();
    }

    /**
     * getReflectionClass 
     * 
     * @access public
     * @return void
     */
    public function getReflectionClass()
    {
        return $this->getDoctrineClassMapping()->getReflectionClass();
    }

    /**
     * isIdentifier 
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function isIdentifier($fieldName)
    {
        return $this->getDoctrineClassMapping()->isIdentifier($fieldName);
    }

    /**
     * hasField 
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function hasField($fieldName)
    {
        return $this->getDoctrineClassMapping()->hasField($fieldName);
    }

    /**
     * hasAssociation 
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function hasAssociation($fieldName)
    {
        return $this->getDoctrineClassMapping()->hasAssociation($fieldName);
    }

    /**
     * isSingleValuedAssociation 
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function isSingleValuedAssociation($fieldName)
    {
        return $this->getDoctrineClassMapping()->isSingleValuedAssociation($fieldName);
    }

    /**
     * isCollectionValuedAssociation 
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function isCollectionValuedAssociation($fieldName)
    {
        return $this->getDoctrineClassMapping()->isCollectionValuedAssociation($fieldName);
    }

    /**
     * getFieldNames 
     * 
     * @access public
     * @return void
     */
    public function getFieldNames()
    {
        return $this->getDoctrineClassMapping()->getFieldNames();
    }

    /**
     * getIdentifierFieldNames 
     * 
     * @access public
     * @return void
     */
    public function getIdentifierFieldNames()
    {
        return $this->getDoctrineClassMapping()->getIdentifierFieldNames();
    }

    /**
     * getAssociationNames 
     * 
     * @access public
     * @return void
     */
    public function getAssociationNames()
    {
        return $this->getDoctrineClassMapping()->getAssociationNames();
    }

    /**
     * getTypeOfField 
     * 
     * @param mixed $fieldName 
     * @access public
     * @return void
     */
    public function getTypeOfField($fieldName)
    {
        return $this->getDoctrineClassMapping()->getTypeOfField($fieldName);
    }

    /**
     * getAssociationTargetClass 
     * 
     * @param mixed $assocName 
     * @access public
     * @return void
     */
    public function getAssociationTargetClass($assocName)
    {
        return $this->getDoctrineClassMapping()->getAssociationTargetClass($assocName);
    }

    /**
     * isAssociationInverseSide 
     * 
     * @param mixed $assocName 
     * @access public
     * @return void
     */
    public function isAssociationInverseSide($assocName)
    {
        return $this->getDoctrineClassMapping()->isAssociationInverseSide($assocName);
    }

    /**
     * getAssociationMappedByTargetField 
     * 
     * @param mixed $assocName 
     * @access public
     * @return void
     */
    public function getAssociationMappedByTargetField($assocName)
    {
        return $this->getDoctrineClassMapping()->getAssociationMappedByTargetField($assocName);
    }

    /**
     * getIdentifierValues 
     * 
     * @param mixed $object 
     * @access public
     * @return void
     */
    public function getIdentifierValues($object)
    {
        return $this->getDoctrineClassMapping()->getIdentifierValues($object);
    }
}

