<?php
namespace Clio\Component\Util\Metadata\Mapping;

use Clio\Component\Util\Container\Collection\Collection;
use Clio\Component\Util\Container\Validator\ClassValidator;

/**
 * MappingCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MappingCollection extends Collection
{
	/**
	 * initContainer 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initContainer()
	{
		$this->setValueValidator(new ClassValidator('Clio\Component\Util\Metadata\Mapping'));
	}

	/**
	 * hasMapping 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasMapping($name)
	{
		return $this->hasKey($name);
	}

	/**
	 * getMapping 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getMapping($name)
	{
		return $this->get($name);
	}

	/**
	 * setMapping 
	 * 
	 * @param mixed $name 
	 * @param Mapping $mapping 
	 * @access public
	 * @return void
	 */
	public function setMapping($name, Mapping $mapping)
	{
		return $this->set($name, $mapping);
	}
}

