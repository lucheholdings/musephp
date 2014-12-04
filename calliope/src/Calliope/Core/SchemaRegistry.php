<?php
namespace Calliope\Core;

use Clio\Component\Pattern\Registry\Registry;

/**
 * SchemaRegistry 
 * 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface SchemaRegistry extends Registry 
{
	/**
	 * getSchema 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function getSchema($name);
}

