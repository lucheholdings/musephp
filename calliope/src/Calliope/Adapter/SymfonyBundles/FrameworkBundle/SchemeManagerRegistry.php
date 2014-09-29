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
	public function hasScheme($name)
	{
		return $this->has($name);
	}

	public function getSchemeManager($name)
	{
		return $this->get($name);
	}

	public function getSchemeManagers()
	{
		throw new \Exception('not supported.');
	}

	/**
	 * addSchemeManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function addSchemeManager(SchemeManagerInterface $manager)
	{
		throw new \Exception('::addSchemeManager not supported.');
	}

	public function setSchemeManager($class, SchemeManagerInterface $manager)
	{
		throw new \Exception('::setSchemeManager is not supported.');
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
		throw new \Exception('::removeScheme is not supported');
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

