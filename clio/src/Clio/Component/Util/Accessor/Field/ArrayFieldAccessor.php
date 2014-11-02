<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * BasicFieldAccessor 
 *    
 * @uses AbstractSingleFieldAccessor
 * @uses FieldAccessorInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
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
		return $container[$this->getField()->getName()];
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
		$container[$this->getField()->getName()] = $value;
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
		return !isset($container[$this->getField()->getName()]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear($container)
	{
		unset($container[$this->getField()->getName()]);
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

