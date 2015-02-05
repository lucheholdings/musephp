<?php
namespace Clio\Component\Util\Metadata\Type\Factory;

use Clio\Component\Util\Metadata\Type\SchemaReferenceType;
use Clio\Component\Util\Metadata\SchemaRegistry;
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
		return new SchemaReferenceType($name);
	}
}

