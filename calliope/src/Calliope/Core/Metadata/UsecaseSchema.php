<?php
namespace Calliope\Core\Metadata;

use Clio\Component\Util\Metadata\Schema\InheritedSchemaMetadata;

/**
 * UsecaseSchema 
 * 
 * @uses InheritedSchemaMetadata
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class UsecaseSchema extends InheritedSchemaMetadata 
{
	/**
	 * getManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getManager()
	{
		return $this->getMapping('schema_manager')->getManager();
	}

	public function getReflectionClass()
	{
		return $this->getParent()->getReflectionClass();
	}

	public function newInstance()
	{
		return $this->newInstanceArgs(func_get_args());
	}

	public function newInstanceArgs(array $args = array())
	{
		return $this->getParent()->newInstanceArgs($args);
	}
}

