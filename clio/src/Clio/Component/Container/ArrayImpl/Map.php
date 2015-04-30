<?php
namespace Clio\Component\Container\ArrayImpl;

use Clio\Component\Container\Map as MapInterface;

/**
 * Map 
 * 
 * @uses AbstractContainer
 * @uses MapInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Map extends AbstractContainer implements MapInterface 
{
    /**
     * {@inheritdoc}
     */
	public function getKeys()
	{
		return array_keys($this->values);
	}

    /**
     * {@inheritdoc}
     */
	public function getValues()
	{
		return array_values($this->values);
	}

    /**
     * {@inheritdoc}
     */
	public function getKeyValues()
	{
		return $this->values;
	}

    /**
     * {@inheritdoc}
     */
	public function set($key, $value)
	{
		if(!$key || empty($key)) {
			throw new \Clio\Component\Exception\InvalidArgumentException('Map requires key to set value.');
		}

		$this->values[$key] = $value;

		return $this;
	}

    /**
     * {@inheritdoc}
     */
	public function get($key)
	{
		if(!array_key_exists($key, $this->values)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Key "%s" is not exists.', (string)$key));
		}
		return $this->values[$key];
	}

    /**
     * {@inheritdoc}
     */
	public function has($key)
	{
		return array_key_exists($key, $this->values);
	}

    /**
     * {@inheritdoc}
     */
	public function remove($key)
	{
		if(!array_key_exists($key, $this->values)) {
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Key "%s" is not exists', $key));
		}
		$removed = $this[$key];
		unset($this->values[$key]);

		return $removed;
	}

    /**
     * {@inheritdoc}
     */
	public function merge(MapInterface $map)
	{
		foreach($map as $key => $value) {
			$this->set($key, $value);
		}
	}

    public function replace(array $values)
    {
        $this->values = array();
        foreach($values as $key => $value) {
            $this->values[$key] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
	public function offsetExists($key)
	{
		return $this->has($key);
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
		return $this->remove($key);
	}
}

