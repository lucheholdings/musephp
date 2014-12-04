<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Loadable;
use Clio\Component\Util\Container\Storage;

class LazyLoadCollection extends Collection implements Loadable 
{
	private $loaded = false;

	private $loader;

	private $postLoadCallbacks = array();

	public function __construct($loader)
	{
		if(!is_callable($loader)) {
			throw new \InvalidArgumentException('$loader has to be a callable.');
		}
		$this->loader = $loader;
	}

	public function load()
	{
		if(!$this->loaded) {
			$this->loadStorage();
			$this->loaded = true;
		}
	}

	public function isLoaded()
	{
		return $this->loaded;
	}

	protected function loadStorage()
	{
		if(!$this->loader) {
			throw new \RuntimeException('Loader is not initialized to load collection.');
		}

		$storage = call_user_func_array($this->loader, array());

		if(!$storage instanceof Storage) {
			throw new \Exception('Failed to load storage. Loader has to return an instanceof Storage.');
		}

		if(!empty($this->postLoadCallbacks)) {
			while($callback = array_shift($this->postLoadCallbacks)) {
				$collection = $callback->__invoke($collection);
			}
		}

		$this->storage = $storage;
	}

	public function setLoader($loader)
	{
		if(!is_callable($loader)) {
			throw new \InvalidArgumentException('Loader has to be a callable array, a Closure or an Invokable Object.');
		}
		$this->loader = $loader;
	}

	public function getStorage()
	{
		if(!$this->isLoaded()) {
			$this->load();
		}

		return $this->storage;
	}
    
    /**
     * Get postLoadCallback.
     *
     * @access public
     * @return postLoadCallback
     */
    public function getPostLoadCallbacks()
    {
        return $this->postLoadCallbacks;
    }
    
    /**
     * Set postLoadCallback.
     *
     * @access public
     * @param postLoadCallback the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function addPostLoadCallback(\Closure $postLoadCallback)
    {
        $this->postLoadCallbacks[] = $postLoadCallback;
        return $this;
    }

	public function filter(\Closure $closure)
	{
		if(!$this->isLoaded()) {
			$this->load();
		}

		parent::filter($closure);
	}

	public function map(\Closure $closure)
	{
		if(!$this->isLoaded()) {
			$this->load();
		}

		return parent::map($closure);
	}
}

