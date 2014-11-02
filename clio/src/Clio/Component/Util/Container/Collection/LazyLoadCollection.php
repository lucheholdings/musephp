<?php
namespace Clio\Component\Util\Container\Collection;

use Clio\Component\Util\Container\Loadable;
use Clio\Component\Util\Container\Storage;

class LazyLoadCollection extends Collection implements Loadable 
{
	private $loaded = false;

	private $loader;

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
			throw new \RuntimeException('Loader has to return an instance of Storage.');
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
}

