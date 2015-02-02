<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Pattern\Constructor\Constructor,
	Clio\Component\Pattern\Constructor\NoConstructConstructor;
use Clio\Component\Tool\Normalizer\Context;

/**
 * ReflectionClassType 
 * 
 * @uses ObjectType
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ReflectionClassType extends AbstractType implements ObjectType, ReferencableType 
{
	private $classReflector;

	private $identifierFields;

	private $constructor;

	private $fieldTypeNames;

	private $dataPool = null;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(\ReflectionClass $classReflector, array $identifierFields = array(), Constructor $constructor = null)
	{
		$this->classReflector = $classReflector;
		$this->identifierFields = $identifierFields;

		if(!$constructor) {
			$constructor = new NoConstructConstructor();
		}
		$this->constructor = $constructor;

		$this->fieldTypeNames = array();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return (string)$this->getClassReflector()->getName();
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
		return $this->constructor->construct($this->getClassReflector());
	}
    
    /**
     * {@inheritdoc}
     */
    public function getClassReflector()
    {
        return $this->classReflector;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierFields()
	{
		return $this->identifierFields;
	}

	public function setIdentifierFields(array $fields)
	{
		$this->identifierFields = $fields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIdentifierValues($data)
	{
		$identifiers = array();
		foreach($this->getIdentifierFields() as $field) {
			$property = $this->classReflector->getProperty($field);
			$property->setAccessible(true);;

			$value = $property->getValue($data); 

			if(!$value) {
				throw new \RuntimeException(sprintf('Identifier "%s" is not filled.', $field));
			}
			$identifiers[$field] = $value;
		}

		return $identifiers;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFieldType($field, Context $context)
	{
		$type = isset($this->fieldTypeNames[$field])
			? $this->fieldTypeNames[$field]
			: 'mixed';

		return $context->getTypeRegistry()->get($type);
	}

	public function setFieldType($field, $type)
	{
		$this->fieldTypeNames[$field] = (string)$type;
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

	/**
	 * {@inheritdoc}
	 */
	public function canReference()
	{
		return !empty($this->identifierFields);
	}

	/**
	 * {@inheritdoc}
	 */
	public function reference()
	{
		return new ReferenceType($this);
	}

	public function createReferencedValue($ids)
	{
		return null;
	}


	public function isValidData($data)
	{
		return $this->getClassReflector()->isInstance($data);
	}

}

