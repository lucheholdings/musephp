<?php
namespace Clio\Component\Metadata\Mapping;

use Clio\Component\Metadata\Mapping;
use Clio\Component\Container\ArrayImpl\Map;

/**
 * Collection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Collection extends Map 
{
	/**
	 * hasMapping 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasMapping($name)
	{
		return $this->has($name);
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

	public function addMapping(Mapping $mapping)
	{
		$this->set($mapping->getName(), $mapping);
	}
}

