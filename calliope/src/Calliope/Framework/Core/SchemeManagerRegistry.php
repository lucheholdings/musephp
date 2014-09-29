<?php
namespace Calliope\Framework\Core;

use Clio\Framework\Registry\ServiceRegistry;
/**
 * SchemeManagerRegistry
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class SchemeManagerRegistry extends ServiceRegistry implements SchemeRegistryInterface 
{
	/**
	 * has 
	 * 
	 * @param SchemeManagerInterface $manager 
	 * @access public
	 * @return void
	 */
	public function hasScheme($schemeClass)
	{
		return $this->has($schemeClass);
	}

	/**
	 * getSchemeManagers 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemeManagers()
	{
		return $this->getAll();
	}

	/**
	 * getSchemeManager 
	 * 
	 * @param mixed $schemeClass 
	 * @access public
	 * @return void
	 */
	public function getSchemeManager($schemeClass)
	{
		return $this->get($schemeClass);
	}

	/**
	 * addSchemeManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function addSchemeManager(SchemeManagerInterface $manager)
	{
		$this->set($manager->getClassMetadata()->getName()], $manager);

		return $this;
	}

	public function setSchemeManager($class, SchemeManagerInterface $manager)
	{
		$this->set($class, $manager);

		return $this;
	}

	/**
	 * removeScheme 
	 * 
	 * @param mixed $schemeClass 
	 * @access public
	 * @return void
	 */
	public function removeScheme($schemeClass)
	{
		$deleted = $this->delete($schemeClass);
		return $deleted;
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return count($this->managers);
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->getSchemeManagers());
	}
}

