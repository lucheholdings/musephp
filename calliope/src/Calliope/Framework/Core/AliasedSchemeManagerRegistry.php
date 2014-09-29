<?php
namespace Calliope\Framework\Core;

use Clio\Component\Exception as Exceptions;
use Calliope\Framework\Core\SchemeManagerInterface;
/**
 * AliasedSchemeManagerRegistry 
 * 
 * @uses SchemeManagerRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AliasedSchemeManagerRegistry extends SchemeManagerRegistry 
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
	 * addSchemeManager 
	 * 
	 * @param SchemeManagerInterface $manager 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function addSchemeManager(SchemeManagerInterface $manager, $alias = null)
	{
		parent::addSchemeManager($manager);
		if($alias) {
			$this->aliases[$alias] = $manager->getClassMetadata()->getName();
		}
	}

	/**
	 * getSchemeManagerByAlias 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function getSchemeManagerByAlias($alias)
	{
		if(!isset($this->aliases[$alias])) {
			throw new Exceptions\InvalidArgumentException(sprintf('Alias "%s" is not registered.', $alias));
		}

		$schemeClass = $this->aliases[$alias];

		return $this->getSchemeManager($schemeClass);
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
		return isset($this->aliases[$alias]) && $this->hasScheme($this->aliases[$alias]);
	}

	public function getAliases()
	{
		return array_keys($this->aliases);
	}

	public function getSchemeManagers()
	{
		$managers = array();

		foreach($this->aliases as $alias => $schemeClass) {
			$managers[$alias] = $this->getSchemeManager($schemeClass);
		}
		return $managers;
	}
}

