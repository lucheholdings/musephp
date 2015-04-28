<?php
namespace Clio\Extra\Type\Factory;

use Clio\Component\Util\Type\Factory\AbstractTypeFactory;
use Clio\Extra\Type;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;

/**
 * ArrayAliasTypeFactory 
 * 
 * @uses AbstractTypeFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayAliasTypeFactory extends AbstractTypeFactory
{
    /**
     * createType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function createType($type, array $options = array())
	{
		switch($type) {
		case Type\Types::TYPE_SET:
		case Type\Types::TYPE_LIST:
			return new Type\SetType();
		case Type\Types::TYPE_MAP:
			return new Type\MapType();
		default:
			break;
		}

		throw new UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
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
		switch($name) {
		case Type\Types::TYPE_SET:
		case Type\Types::TYPE_MAP:
		case Type\Types::TYPE_LIST:
			return true;
		default:
			return false;
		}
	}
}

