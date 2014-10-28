<?php
namespace Clio\Component\Pattern\Registry\Loader;

use Clio\Component\Pattern\Registry\LoadableRegistry;
use Clio\Component\Pattern\Registry\EntryLoader;

/**
 * AbstractLoader 
 * 
 * @uses EntryLoader
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractLoader implements EntryLoader
{
	/**
	 * register 
	 * 
	 * @param LoadableRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function register(LoadableRegistry $registry, $priority = 0)
	{
		$registry->getLoaders()->add($this, $priority);
		return $this;
	}

	/**
	 * unregister 
	 * 
	 * @param LoadableRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function unregister(LoadableRegistry $registry)
	{
		$registry->getLoaders()->remove($this);
		return $this;
	}
}
