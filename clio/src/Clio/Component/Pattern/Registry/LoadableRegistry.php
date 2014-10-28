<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Pattern\Registry\Loader\LoaderCollection;
use Clio\Component\Pattern\Registry\EntryLoader;

/**
 * LoadableRegistry 
 * 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LoadableRegistry extends ProxyRegistry 
{
	/**
	 * loaders 
	 * 
	 * @var array
	 * @access private
	 */
	private $loaders = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Registry $registry)
	{
		parent::__construct($registry);
		$this->loaders = new LoaderCollection();
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($key)
	{
		if(!$this->getRegistry()->has($key)) {
			$entry = null;
			// Load for the key
			foreach($this->loaders as $loader) {
				if($loader->canLoad($key)) {
					$entry = $loader->loadEntry($key);
					break;
				}
			}
			
			if($entry) {
				$this->getRegistry()->set($key, $entry);
			}
		}

		return $this->getRegistry()->get($key);
	}

	public function has($key)
	{
		if($this->registry->has($key)) {
			return true;
		}

		// 
		foreach($this->loaders as $loader) {
			if($loader->canLoad($key)) {
				return true;
			}
		}
		return false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getLoaders()
	{
		return $this->loaders;
	}

	public function addLoader(EntryLoader $loader)
	{
		$this->loaders->add($loader);
	}
}

