<?php
namespace Calliope\Framework\Core;

use Clio\Component\Exception as Exceptions;
use Calliope\Framework\Core\SchemaManagerInterface;
/**
 * AliasedSchemaManagerRegistry 
 * 
 * @uses SchemaManagerRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AliasedSchemaManagerRegistry extends SchemaManagerRegistry 
{
	private $aliases;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->aliases = array();
	}

	/**
	 * addSchemaManager 
	 * 
	 * @param SchemaManagerInterface $manager 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function addSchemaManager(SchemaManagerInterface $manager, $alias = null)
	{
		parent::addSchemaManager($manager);
		if($alias) {
			$this->aliases[$alias] = $manager->getClassMetadata()->getName();
		}
	}

	/**
	 * getSchemaManagerByAlias 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function getSchemaManagerByAlias($alias)
	{
		if(!isset($this->aliases[$alias])) {
			throw new Exceptions\InvalidArgumentException(sprintf('Alias "%s" is not registered.', $alias));
		}

		$schemeClass = $this->aliases[$alias];

		return $this->getSchemaManager($schemeClass);
	}

	/**
	 * hasAlias 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function hasAlias($alias)
	{
		return isset($this->aliases[$alias]) && $this->hasSchema($this->aliases[$alias]);
	}

	public function getAliases()
	{
		return array_keys($this->aliases);
	}

	public function getSchemaManagers()
	{
		$managers = array();

		foreach($this->aliases as $alias => $schemeClass) {
			$managers[$alias] = $this->getSchemaManager($schemeClass);
		}
		return $managers;
	}
}

