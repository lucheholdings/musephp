<?php
namespace Erato\Core\Type\Factory;

use Clio\Component\Util\Type\Factory\AbstractTypeFactory;
use Erato\Core\Type;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;
use Clio\Component\Util\Type\NullType;

/**
 * DecorateTypeFactory 
 * 
 * @uses AbstractTypeFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DecorateTypeFactory extends AbstractTypeFactory
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
		switch($name) {
		case Type\Types::TYPE_IDENTIFIER:
			return new Type\IdentifierType($options['decorated_type']);
		default:
			break;
		}

		throw new UnsupportedException(sprintf('Unknown type "%s" to create.', $name));
	}

	/**
	 * isSupportedType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportedType($type)
	{
		return (Type\Types::TYPE_IDENTIFIER == $type);
	}
}

