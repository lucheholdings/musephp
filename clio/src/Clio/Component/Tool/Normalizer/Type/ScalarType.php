<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;

/**
 * ScalarType 
 * 
 * @uses NamedType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScalarType extends NamedType 
{
	/**
	 * {@inheritdoc}
	 */
	public function getFieldType($field, Context $context)
	{
		throw new \RuntimeException('Scalar cannot have a subfield.');
	}

	public function isValidData($data)
	{
		switch($this->getName()) {
		case self::TYPE_INT:
		case self::TYPE_INTEGER:
		case Type::TYPE_FLOAT:
		case Type::TYPE_DOUBLE:
			return is_numeric($data);
		case Type::TYPE_STRING:
			return is_string($data);
		case Type::TYPE_BOOL:
		case Type::TYPE_BOOLEAN:
			return is_bool($data);
		}

		return false;
	}
}

