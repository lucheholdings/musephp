<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Pattern\Factory\UnsupportedException;

/**
 * ScalarType 
 * 
 * @uses AbstractType
 * @uses Convertable
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScalarType extends AbstractType implements Convertable 
{
	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name)
	{
		switch($name) {
		case PrimitiveTypes::TYPE_ALIAS_INT:
			$name = PrimitiveTypes::TYPE_INTEGER;
			break;
		case PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
			$name = PrimitiveTypes::TYPE_CHAR;
			break;
		case PrimitiveTypes::TYPE_ALIAS_BOOL:
			$name = PrimitiveTypes::TYPE_BOOLEAN;
			break;
		// Supported types
		case PrimitiveTypes::TYPE_INTEGER:
		case PrimitiveTypes::TYPE_DOUBLE:
		case PrimitiveTypes::TYPE_FLOAT:
		case PrimitiveTypes::TYPE_CHAR:
		case PrimitiveTypes::TYPE_STRING:
		case PrimitiveTypes::TYPE_BOOLEAN:
		case PrimitiveTypes::TYPE_REAL:
		case PrimitiveTypes::TYPE_BINARY:
			break;
		default:
			throw new UnsupportedException(sprintf('Type "%s" is not Scalar value', $name));
		}
		parent::__construct($name);
	}

	/**
	 * isType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isType($type)
	{
		switch($type) {
		case 'scalar':
			return true;
		default:
			return $type == $this->getName();
		}
	}

	/**
	 * isValidData 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function isValidData($value)
	{
		return is_scalar($value) && ($this->getName() == gettype($value));
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
		if(!$this->isValidData($data)) {
			throw new \InvalidArgumentException(sprintf('Argument 1 is not a valida data type for "%s"', $this->getName()));
		}

		if(($type->isType(PrimitiveTypes::BASETYPE_SCALAR)) && $data) {
			// convert scalar to scalar.
			switch($type->getName()) {
			case PrimitiveTypes::TYPE_STRING:
				return (string)$data;
			case PrimitiveTypes::TYPE_BOOLEAN:
				return (bool)$data;
			case PrimitiveTypes::TYPE_INTEGER:
				return (int)$data;
			case PrimitiveTypes::TYPE_FLOAT:
				return (float)$data;
			case PrimitiveTypes::TYPE_DOUBLE:
				return (double)$data;
			case PrimitiveTypes::TYPE_REAL:
				return (real)$data;
			case PrimitiveTypes::TYPE_NULL:
				return (unset)$data;
			case PrimitiveTypes::TYPE_BINARY:
				return (binary)$data;
			case PrimitiveTypes::TYPE_ARRAY;
				return (array)$data;
			default:
				throw new UnsupportedException(sprintf('Conversion from Type "%s" to Type "%s" is ambiguous.', $this->getName(), $type->getName()));
			}
		} else if($type->isType(PrimitiveTypes::BASETYPE_OBJECT)) {
			throw new UnsupportedException('Please use Normalizer to denormalize Object from data.');
		} else {
			// 
			throw new UnsupportedException('Please use Normalizer to denormalize Data from scalar data.');
		}
	}
}

