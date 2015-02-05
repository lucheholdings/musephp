<?php
namespace ;

use Clio\Component\Util\Metadata\

class FieldType  
{
	private $fieldType;

	public function __construct(FieldType $fieldType)
	{
		$this->fieldType = $fieldType;
	}

	public function getIdentifierFields()
	{
		if($this->getSchema()->hasMapping('identifier')) {
			$fields = $this->getSchema()->getMapping('identifier')->getFields();

			return array_map(function($field) {
					return $this->getCodingStandard()->formatNaming(CodingStandard::NAMING_ARRAY_FIELD, $field->getName());
				}, $fields);
		}

		return null;
	}

	public function getIdentifierValues($data)
	{
		if($this->getSchema()->hasMapping('identifier')) {
			$this->getSchema()->getMapping('identifier')->getFieldValues($data);
		}

		return array();
	}

	public function getFieldType($field)
	{
		$field = $this->getSchema()->getField();

		if($field->hasMapping('normalizer')) {
			return $field->getMapping('normalizer')->getType();
		} else {
			return $field->getType();
		}
	}

    public function getSchema()
    {
        $type = $this->getFieldType()->getType();
		if($type instanceof SchemaRefenrenceType) {
			return $type->getSchema();
		}
		throw new \RuntimeException('Type is not a SchemaReferenceType');
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
		return $this->getSchema()->isSchemaData($data);
	}

	public function construct(array $args = array())
	{
		return $this->getSchema()->newInstanceArgs($args);
	}

	public function canReference()
	{
		return !empty($this->getIdetifierFields());
	}

	public function reference()
	{
		return new ReferenceType($this);
	}
}

