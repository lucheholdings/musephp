<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Bridge\DoctrineCache\Container;

use Clio\Component\Util\Container\Container as ContainerInterface;
use Clio\Component\Util\Container\Map as MapInterface;

/**
 * CachedMap 
 *   CachedMap is a Map Container which wrap another Map with Cache.
 *   
 * @uses CachedContainer
 * @uses MapInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CachedMap extends CachedContainer implements MapInterface 
{
	public function toArray()
	{
		return $this->getContainer()->toArray();
	}

	public function clear()
	{
		$this->getContainer()->clear();
		$this->getCache()->flush();
		
		return $this;
	}

	public function getKeys()
	{
		return $this->getContainer()->getKeys();
	}

	public function getValues()
	{
		return $this->getContainer()->getValues();
	}

	public function getKeyValueArray()
	{
		return $this->getContainer()->getKeyValueArray();
	}

	public function hasKey($key)
	{
		return ($this->getCache()->contains($key) || $this->getContainer()->hasKey($key));
	}

	public function get($key)
	{
		if(!$this->isCached($key)) {
			$value = $this->getCache()->fetch($key);
		} else {
			// Fetch from original storage and store into cache.
			$value = $this->getContainer()->get($key);
			$this->getCache()->save($key, $value);
		}

		return $value;
	}

	public function set($key, $value)
	{
		$this->getContainer()->set($key, $value);
		$this->getCache()->save($key, $value);

		return $this;
	}

	public function remove($key)
	{
		// 
		if($this->isCached($key)) {
			$this->getCache()->remove($key);
		}	

		return $this->getContainer()->remove($key);
	}

    public function setContainer(ContainerInterface $container)
    {
		if(!$container instanceof MapInterface) {
			throw new \InvalidArgumentException('Container has to be an instance of Map for CachedMap.');
		}

		return parent::setContainer($container);
    }


	public function count()
	{
		return $this->getContainer()->count();
	}

	public function getIterator()
	{
		return $this->getContainer()->getIterator();
	}

	/**
	 * offsetExists 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetExists($key)
	{
		return $this->hasKey($key);
	}

	/**
	 * offsetGet 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	/**
	 * offsetSet 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		return $this->set($key, $value);
	}

	/**
	 * offsetUnset 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetUnset($key)
	{
		return $this->removeByKey($key);
	}
}


