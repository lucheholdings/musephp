<?php
namespace Clio\Component\Util\Metadata\Type\Loader;

/**
 * BasicTypeLoader 
 *    
 * @uses LoaderFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicTypeLoader extends LoaderCollection 
{
	/**
	 * __construct 
	 * 
	 * @param SchemaRegistry $schemaRegistry 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaRegistry $schemaRegistry)
	{
		parent::__construct(array(
				new SchemaTypeFactory($schemaRegistry),
				new PrimitiveTypeFactory(),
			));
	}
}

