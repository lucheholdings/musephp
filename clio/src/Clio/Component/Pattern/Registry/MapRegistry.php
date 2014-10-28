<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Util\Container\Map\Map;

/**
 * MapRegistry 
 * 
 * @uses AbstractRegistry
 * @uses Registry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MapRegistry implements Registry 
{
	/**
	 * map 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $map;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->map = new Map();
	}

	/**
	 * {@inheritdoc}
	 */
	public function has($key)
	{
		return $this->map->hasKey((string)$key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($key)
	{
		$key = (string)$key;
		if(!$this->map->hasKey($key))
			return null;
		return $this->map->get($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($key, $value)
	{
		$this->map->set((string)$key, $value);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($key)
	{
		return $this->map->remove((string)$key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear()
    {
        return $this->map->clear();
    }

	/**
	 * {@inheritdoc}
	 */
	public function count()
    {
        return $this->map->count();
    }

	/**
	 * {@inheritdoc}
	 */
	public function toArray()
    {
        return $this->map->toArray();
    }

	/**
	 * getMap 
	 * 
	 * @access public
	 * @return void
	 */
	public function getMap()
	{
		return $this->map;
	}
}

