<?php
namespace Clio\Component\Util\Type\Actual;

use Clio\Component\Util\Type\Type;
use Clio\Component\Util\Type\PrimitiveTypes;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;

/**
 * ScalarType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScalarType extends AbstractType 
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
		switch(strtolower($name)) {
		case PrimitiveTypes::TYPE_ALIAS_INTEGER:
			$name = PrimitiveTypes::TYPE_INT;
			break;
		case PrimitiveTypes::TYPE_ALIAS_CHAR:
		case PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
			$name = PrimitiveTypes::TYPE_STRING;
			break;
		case PrimitiveTypes::TYPE_ALIAS_BOOLEAN:
			$name = PrimitiveTypes::TYPE_BOOL;
			break;
		case PrimitiveTypes::TYPE_ALIAS_REAL:
		case PrimitiveTypes::TYPE_ALIAS_DOUBLE:
			$name = PrimitiveTypes::TYPE_FLOAT;
			break;
		// Supported types
		case PrimitiveTypes::TYPE_INT:
		case PrimitiveTypes::TYPE_FLOAT:
		case PrimitiveTypes::TYPE_STRING:
		case PrimitiveTypes::TYPE_BOOL:
			break;
		default:
			throw new UnsupportedException(sprintf('Type "%s" is not Scalar value', $name));
		}
		parent::__construct(strtolower($name));
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
		return (is_scalar($value) && ($this->getName() == gettype($value))) || ((PrimitiveTypes::TYPE_STRING == $this->getName()) && is_object($value) && method_exists($object, '__toString'));
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
			case PrimitiveTypes::TYPE_BOOL:
				return (bool)$data;
			case PrimitiveTypes::TYPE_INT:
				return (int)$data;
			case PrimitiveTypes::TYPE_FLOAT:
				return (float)$data;
			case PrimitiveTypes::TYPE_NULL:
				return null;
			case PrimitiveTypes::TYPE_ARRAY;
				return (array)$data;
			default:
				throw new UnsupportedException(sprintf('Conversion from Type "%s" to Type "%s" is ambiguous.', $this->getName(), $type->getName()));
			}
		} else {
			return parent::convertData($data, $type);
		}
	}

    /**
     * newData 
     * 
     * @access public
     * @return void
     */
    public function newData()
    {
		switch($this->getName()) {
		case PrimitiveTypes::TYPE_STRING:
			return '';
		case PrimitiveTypes::TYPE_BOOL:
			return false;
		case PrimitiveTypes::TYPE_INT:
		case PrimitiveTypes::TYPE_FLOAT:
			return 0;
		case PrimitiveTypes::TYPE_NULL:
			return null;
		case PrimitiveTypes::TYPE_ARRAY;
			return array();
		default:
			throw new UnsupportedException(sprintf('createNew from Type "%s" is not supported.', $this->getName()));
		}
    }
}

