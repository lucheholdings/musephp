<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Container\Map\StorageMap;

/**
 * MapRegistry 
 * 
 * @uses StorageMap 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MapRegistry implements Registry 
{
    private $registered;

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return isset($this->registered[$key]);
    }
    /**
     * {@inheritdoc}
     */
	public function get($key)
    {
        return $this->registered[$key];
    }

    /**
     * {@inheritdoc}
     */
	public function set($key, $entry)
    {
        $this->registered[$key] = $entry;
    }

    /**
     * {@inheritdoc}
     */
	public function remove($key)
    {
        unset($this->registered[$key]);
    }

    /**
     * {@inheritdoc}
     */
	public function clear()
    {
        $this->registered = array();
    }

    /**
     * {@inheritdoc}
     */
	public function count()
    {
        return count($this->registered);
    }
}
