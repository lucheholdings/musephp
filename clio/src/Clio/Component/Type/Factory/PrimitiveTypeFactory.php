<?php
namespace Clio\Component\Type\Factory;

use Clio\Component\Type\MixedType;
use Clio\Component\Type\Actual as ActualTypes;
use Clio\Component\Type\PrimitiveTypes;
use Clio\Component\Pattern\Factory;

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
     * doCreateType 
     * 
     * @param mixed $name 
     * @param array $options 
     * @access protected
     * @return void
     */
	protected function doCreateType($name, array $options = array())
	{
		switch(strtolower($name)) {
		case PrimitiveTypes::TYPE_NULL:
			return new ActualTypes\NullType();
		case PrimitiveTypes::TYPE_MIXED:
			return new MixedType();
		case PrimitiveTypes::TYPE_INT:
		case PrimitiveTypes::TYPE_FLOAT:
		case PrimitiveTypes::TYPE_STRING:
		case PrimitiveTypes::TYPE_BOOL:
		case PrimitiveTypes::TYPE_ALIAS_CHAR:
		case PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
		case PrimitiveTypes::TYPE_ALIAS_INTEGER:
		case PrimitiveTypes::TYPE_ALIAS_BOOLEAN:
		case PrimitiveTypes::TYPE_ALIAS_DOUBLE:
		case PrimitiveTypes::TYPE_ALIAS_REAL:
			return new ActualTypes\ScalarType($name);
		case PrimitiveTypes::TYPE_ARRAY:
			return new ActualTypes\ArrayType($name);
		default:
			break;
		}

		throw new Factory\Exception\UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
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
		case PrimitiveTypes::TYPE_NULL:
		case PrimitiveTypes::TYPE_MIXED:
		case PrimitiveTypes::TYPE_INT:
		case PrimitiveTypes::TYPE_FLOAT:
		case PrimitiveTypes::TYPE_STRING:
		case PrimitiveTypes::TYPE_BOOL:
		case PrimitiveTypes::TYPE_ARRAY:
		case PrimitiveTypes::TYPE_ALIAS_CHAR:
		case PrimitiveTypes::TYPE_ALIAS_CHARACTOR:
		case PrimitiveTypes::TYPE_ALIAS_INTEGER:
		case PrimitiveTypes::TYPE_ALIAS_BOOLEAN:
		case PrimitiveTypes::TYPE_ALIAS_DOUBLE:
		case PrimitiveTypes::TYPE_ALIAS_REAL:
			return true;
		default:
			return false;
		}
	}
}

