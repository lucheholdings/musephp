<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle;

use Calliope\Framework\Core\SchemaRegistryInterface;
use Calliope\Framework\Core\SchemaManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Clio\Framework\Registry\AliasServiceRegistry;
/**
 * SchemaManagerRegistry 
 *   AliasedBy SchemaClassName 
 * @uses AliasedSchemaManagerRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaManagerRegistry extends AliasServiceRegistry implements SchemaRegistryInterface 
{
	public function hasSchema($name)
	{
		return $this->has($name);
	}

	public function getSchemaManager($name)
	{
		return $this->get($name);
	}

	public function getSchemaManagers()
	{
		throw new \Exception('not supported.');
	}

	/**
	 * addSchemaManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function addSchemaManager(SchemaManagerInterface $manager)
	{
		throw new \Exception('::addSchemaManager not supported.');
	}

	public function setSchemaManager($class, SchemaManagerInterface $manager)
	{
		throw new \Exception('::setSchemaManager is not supported.');
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
		throw new \Exception('::removeSchema is not supported');
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
