<?php
namespace Calliope\Framework\Core;

use Clio\Framework\Registry\ServiceRegistry;
/**
 * SchemaManagerRegistry
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class SchemaManagerRegistry extends ServiceRegistry implements SchemaRegistryInterface 
{
	/**
	 * has 
	 * 
	 * @param SchemaManagerInterface $manager 
	 * @access public
	 * @return void
	 */
	public function hasSchema($schemeClass)
	{
		return $this->has($schemeClass);
	}

	/**
	 * getSchemaManagers 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemaManagers()
	{
		return $this->getAll();
	}

	/**
	 * getSchemaManager 
	 * 
	 * @param mixed $schemeClass 
	 * @access public
	 * @return void
	 */
	public function getSchemaManager($schemeClass)
	{
		return $this->get($schemeClass);
	}

	/**
	 * addSchemaManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function addSchemaManager(SchemaManagerInterface $manager)
	{
		$this->set($manager->getClassMetadata()->getName()], $manager);

		return $this;
	}

	public function setSchemaManager($class, SchemaManagerInterface $manager)
	{
		$this->set($class, $manager);

		return $this;
	}

	/**
	 * removeSchema 
	 * 
	 * @param mixed $schemeClass 
	 * @access public
	 * @return void
	 */
	public function removeSchema($schemeClass)
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
		return new \ArrayIterator($this->getSchemaManagers());
	}
}

