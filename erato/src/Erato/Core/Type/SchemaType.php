<?php
namespace Erato\Core\Type;

use Clio\Component\Metadata\Type\SchemaReferenceType as BaseType;

// implements normalizer types
use Clio\Component\Normalizer\Type\Types as NormalizerTypes;
use Clio\Component\Normalizer\Type\ReferencableType;
use Clio\Component\Normalizer\Type\ReferenceType;
use Clio\Component\Type\Type;

/**
 * SchemaType 
 * 
 * @uses BaseType
 * @uses ReferencableType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaType extends BaseType implements ReferencableType 
{
	public function isType($type)
	{
		switch($type) {
		case NormalizerTypes::TYPE_REFERENCABLE:
			return $this->getSchema()->hasMapping('identifier') && $this->getSchema()->getMapping('identifier')->hasFields();
		default:
			return parent::isType($type);
		}
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
		return $this->getIdentifierMapping()->getFieldValues($data);
	}

	protected function getIdentifierMapping()
	{
		return $this->getSchema()->getMapping('identifier');
	}

	/**
	 * convertData 
	 *   
	 * @param mixed $data 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function convertData($data, Type $type)
	{
		if($type->isType(Types::TYPE_IDENTIFIER)) {
			return $this->getIdentifierValues($data);
		}

		return parent::convertData($data, $type);
	}
}

