<?php
namespace Erato\Core\Type\Factory;

use Erato\Core\Type\SchemaType;
use Clio\Component\Util\Type\Factory\AbstractTypeFactory;

/**
 * SchemaTypeFactory 
 * 
 * @uses AbstractTypeFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaTypeFactory extends AbstractTypeFactory
{
	/**
	 * createType 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function createType($name)
	{
		return new SchemaType($name);
	}
}

