<?php
namespace Erato\Core\Type;

use Clio\Component\Util\Metadata\Type\SchemaReferenceType as BaseType;

// implements normalizer types
use Clio\Component\Tool\Normalizer\Type\Types as NormalizerTypes;
use Clio\Component\Tool\Normalizer\Type\ReferencableType;
use Clio\Component\Tool\Normalizer\Type\ReferenceType;

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
}

