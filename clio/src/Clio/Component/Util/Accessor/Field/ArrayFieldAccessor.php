<?php
namespace Clio\Compnent\Util\Accessor\Field;

/**
 * BasicFieldAccessor 
 * 
 * @uses AbstractFieldAccessor
 * @uses FieldAccessorInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArrayFieldAccessor extends AbstractFieldAccessor implements FieldAccessorInterface 
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
	public function set($container)
	{
		$container[$this->getFieldName()] = $value;
		return $this;
	}

	/**
	 * isExists 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function isExists($container)
	{
		return isset($container[$this->getFieldName()]);
	}

	/**
	 * delete 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function delete($container)
	{
		unset($container[$this->getFieldName()]);
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

