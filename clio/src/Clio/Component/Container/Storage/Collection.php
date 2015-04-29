<?php
namespace Clio\Component\Container\Storage;

use Clio\Component\Container\Collection as CollectionInterface;

/**
 * Collection 
 * 
 * @uses StorageContainer
 * @uses CollectionInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Collection extends AbstractContainer implements CollectionInterface
{
    /**
     * {@inheritdoc}
     */
	public function has($value)
	{
		return $this->getStorage()->exists($value);
	}

	public function hasKey($key)
	{
		return $this->getStorage()->existsAt($key);
	}

    /**
     * {@inheritdoc}
     */
	public function getKeys()
	{
		return array_keys($this->toArray());
	}

    /**
     * {@inheritdoc}
     */
	public function getKeyValues()
	{
		return $this->toArray();
	}

    /**
     * {@inheritdoc}
     */
	public function get($key)
	{
		return $this->getStorage()->getAt($key);
	}

    /**
     * {@inheritdoc}
     */
	public function set($key, $value)
	{
		$this->getStorage()->insertAt($key, $value);
		return $this;
	}

    /**
     * {@inheritdoc}
     */
	public function remove($value)
	{
		$this->getStorage()->remove($key);
	}

    /**
     * {@inheritdoc}
     */
	public function removeByKey($key)
	{
		$this->getStorage()->removeAt($key);
	}

    /**
     * {@inheritdoc}
     */
	public function offsetExists($key)
	{
		return $this->hasKey($key);
	}

    /**
     * {@inheritdoc}
     */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

    /**
     * {@inheritdoc}
     */
	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

    /**
     * {@inheritdoc}
     */
	public function offsetUnset($key)
	{
		$this->removeByKey($key);
	}
}

