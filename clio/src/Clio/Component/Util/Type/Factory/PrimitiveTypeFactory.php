<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Util\Type\Actual as ActualTypes;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;

/**
 * PrimitiveTypeFactory 
 * 
 * @uses AbstractTypeFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PrimitiveTypeFactory extends AbstractTypeFactory
{
    /**
     * createType 
     * 
     * @param mixed $name 
     * @param array $options 
     * @access public
     * @return void
     */
	public function createType($name, array $options = array())
	{
		switch(strtolower($name)) {
		case ActualTypes\PrimitiveTypes::TYPE_NULL:
			return new ActualTypes\NullType();
		case ActualTypes\PrimitiveTypes::TYPE_MIXED:
			return new ActualTypes\MixedType();
		case ActualTypes\PrimitiveTypes::TYPE_ALIAS_INT:
		case ActualTypes\PrimitiveTypes::TYPE_INTEGER:
		case ActualTypes\PrimitiveTypes::TYPE_DOUBLE:
		case ActualTypes\PrimitiveTypes::TYPE_FLOAT:
		case ActualTypes\PrimitiveTypes::TYPE_CHAR:
		case ActualTypes\PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
		case ActualTypes\PrimitiveTypes::TYPE_STRING:
		case ActualTypes\PrimitiveTypes::TYPE_ALIAS_BOOL:
		case ActualTypes\PrimitiveTypes::TYPE_BOOLEAN:
			return new ActualTypes\ScalarType($name);
		case ActualTypes\PrimitiveTypes::TYPE_ARRAY:
			return new ActualTypes\ArrayType($name);
		default:
			break;
		}

		throw new UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
	}

    /**
     * createTypeForValue 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function createTypeForValue($value)
	{
		if(is_scalar($value)) {

		} else if(is_array($value)) {
			return $this->doCreateType(ActualTypes\PrimitiveTypes::TYPE_ARRAY);
		}
	}

    /**
     * isSupportedType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function isSupportedType($name)
	{
		switch(strtolower($name)) {
		case ActualTypes\PrimitiveTypes::TYPE_NULL:
		case ActualTypes\PrimitiveTypes::TYPE_MIXED:
		case ActualTypes\PrimitiveTypes::TYPE_ALIAS_INT:
		case ActualTypes\PrimitiveTypes::TYPE_INTEGER:
		case ActualTypes\PrimitiveTypes::TYPE_DOUBLE:
		case ActualTypes\PrimitiveTypes::TYPE_FLOAT:
		case ActualTypes\PrimitiveTypes::TYPE_CHAR:
		case ActualTypes\PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
		case ActualTypes\PrimitiveTypes::TYPE_STRING:
		case ActualTypes\PrimitiveTypes::TYPE_ALIAS_BOOL:
		case ActualTypes\PrimitiveTypes::TYPE_BOOLEAN:
		case ActualTypes\PrimitiveTypes::TYPE_ARRAY:
			return true;
		default:
			return false;
		}
	}
}

