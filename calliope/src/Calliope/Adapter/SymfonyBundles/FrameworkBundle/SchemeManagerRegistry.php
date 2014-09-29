<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle;

use Calliope\Framework\Core\SchemeRegistryInterface;
use Calliope\Framework\Core\SchemeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Clio\Framework\Registry\AliasServiceRegistry;
/**
 * SchemeManagerRegistry 
 *   AliasedBy SchemeClassName 
 * @uses AliasedSchemeManagerRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeManagerRegistry extends AliasServiceRegistry implements SchemeRegistryInterface 
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
		return $this->hasAlias($schemeClass);
	}

	/**
	 * getSchemeManagers 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemeManagers()
	{
		$aliases = $this->getAliases();

		$values;
		foreach($aliases as $alias => $id) {
			$values[$alias] = $this->get($alias);
		}

		return $values;
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
		$this->set($manager->getClassMetadata()->getName(), $manager);

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
		$deleted = $this->removeAlias($schemeClass);
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

