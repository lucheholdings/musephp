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
	 * loader 
	 * 
	 * @var array
	 * @access private
	 */
	private $loader = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(EntryLoader $loader = null, Registry $registry = null)
	{
		if(!$registry) {
			$registry = new RegistryMap();
		}
		parent::__construct($registry);

		$this->loader = $loader;
	}

	public function isLoaded($key)
	{
		return $this->getRegistry()->has($key);
	}

	public function load($key, array $options = array())
	{
		$entry = null;
		// Load for the key
		if($this->loader && $this->loader->canLoad($key)) {
			$entry = $this->loader->loadEntry($key, $options);
		}
		
		return $entry;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($key)
	{
		if(!$this->getRegistry()->has($key)) {
			$entry = $this->load($key);

			if($entry) {
				$this->getRegistry()->set($key, $entry);
			}
		}

		return $this->getRegistry()->get($key);
	}

	public function has($key)
	{
		if($this->getRegistry()->has($key)) {
			return true;
		}

		// 
		if($this->loader->canLoad($key)) {
			return true;
		}
		return false;
	}

	public function getLoader()
	{
		return $this->loader;
	}

	/**
	 * setLoader 
	 * 
	 * @param EntryLoader $loader 
	 * @access public
	 * @return void
	 */
	public function setLoader(EntryLoader $loader)
	{
		$this->loader = $loader;
	}
}

