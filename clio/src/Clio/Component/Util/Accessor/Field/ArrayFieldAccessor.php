<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * ArrayFieldAccessor 
 * 
 * @uses AbstractSingleFieldAccessor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ArrayFieldAccessor extends AbstractSingleFieldAccessor 
{
	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function get($container)
	{
		return $container[$this->getFieldName()];
	}

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function set($container, $value)
	{
		$container[$this->getFieldName()] = $value;
		return $this;
	}

	/**
	 * isNull
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function isNull($container)
	{
		return !isset($container[$this->getFieldName()]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear($container)
	{
		unset($container[$this->getFieldName()]);
		return $this;
	}

	/**
	 * validateContainer 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function validateContainer($container)
	{
		return ($container instanceof \ArrayAccess);
	}
}

