<?php
namespace Erato\Core\Type;

use Clio\Component\Util\Type\FieldType;

class IdentifierType extends FieldType implements ReferenableType 
{
	public function isType($type)
	{
		switch($type) {
		case Types::TYPE_IDENTIFIER:
			return true;
		default:
			break;
		}
		return false;
	}

	public function isValidData($value)
	{
		return is_array($value) && $this->getIdentifierMapping()->validateValues($value); 
	}

	public function reference()
	{
		return new ReferenceType($this);
	}

	public function getIdentifierFields()
	{
		return $this->getIdentifierMapping()->getFieldNames();
	}

	public function getIdentifierValues($data)
	{
		return $data;
	}

	protected function getIdentifierMapping()
	{
		return $this->getSchema()->getMapping('identifier');
	}
}
