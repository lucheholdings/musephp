<?php
namespace Erato\Core\Normalizer\Type;

use Clio\Component\Normalizer\Type\AbstractType,
	Clio\Component\Normalizer\Type\ObjectType,
	Clio\Component\Normalizer\Type\ReferenceType;
use Clio\Component\Normalizer\Context;
use Clio\Component\Normalizer\Type\DataPool;

use Clio\Component\Metadata\SchemaMetadata;
use Erato\Core\CodingStandard;

class MetadataType extends AbstractType implements ObjectType 
{
	private $metadata;

	private $identifierFields;

	private $codingStandard;
	
	private $dataPool;

	public function __construct(SchemaMetadata $metadata, CodingStandard $codingStandard = null)
	{
		$this->metadata = $metadata;

		if(!$codingStandard) 
			$codingStandard = new CodingStandard();
		$this->codingStandard = $codingStandard;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return (string)$this->getMetadata()->getName();
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return $this->getName();
	}

	/**
	 * {@inheritdoc}
	 */
	public function construct()
	{
		return $this->getMetadata()->newInstance();
	}
    
    /**
     * {@inheritdoc}
     */
    public function getClassReflector()
    {
        return $this->getMetadata()->getReflectionClass();
    }

	/**
	 * {@inheritdoc}
	 */
	public function canReference()
	{
		$identifiers = $this->getIdentifierFields();
		return !empty($identifiers);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierFields()
	{
		if(!$this->identifierFields) {
			$identifiers = array();

			$identifiers = $this->getMetadata()->getMapping('identifier')->getFields();

			$this->identifierFields = array_map(function($field){
				return $this->getCodingStandard()->formatNaming(CodingStandard::NAMING_ARRAY_FIELD, $field->getName());
			}, $identifiers);
		}
		return $this->identifierFields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierValues($data)
	{
		return $this->getMetadata()->getMapping('identifier')->getFieldValues($data);
		//$identifiers = array();
		//foreach($this->getIdentifierFields() as $field) {
		//	$property = $this->getClassReflector()->getProperty($this->getCodingStandard()->formatNaming(CodingStandard::NAMING_PROPERTY, $field));
		//	$property->setAccessible(true);;

		//	$value = $property->getValue($data); 

		//	if(!$value) {
		//		throw new \RuntimeException(sprintf('Identifier "%s" is not filled.', $field));
		//	}
		//	$identifiers[$field] = $value;
		//}

		//return $identifiers;
	}

	/**
	 * {@inheritdoc}
	 */
	public function reference()
	{
		return new ReferenceType($this);
	}

	public function createReferencedValue(array $ids)
	{
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFieldType($field, Context $context)
	{
		$propertyName = $this->getCodingStandard()->formatNaming(CodingStandard::NAMING_PROPERTY, $field);

		if($this->getMetadata()->hasField($propertyName))
			$type = $this->getMetadata()->getField($propertyName)->getMapping('normalizer')->getType($context);
		else 
			$type = 'mixed';

		return $context->getTypeResolver()->resolve($type);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDataPool()
	{
		if(!$this->dataPool) {
			$this->dataPool = new DataPool($this);
		}

		return $this->dataPool;
	}
    
    public function getMetadata()
    {
        return $this->metadata;
    }
    
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }
    
    public function getCodingStandard()
    {
        return $this->codingStandard;
    }
    
    public function setCodingStandard(CodingStandard $codingStandard)
    {
        $this->codingStandard = $codingStandard;
        return $this;
    }

	public function isValidData($data)
	{
		return $this->getMetadata()->isSchemaData($data);
	}
}

