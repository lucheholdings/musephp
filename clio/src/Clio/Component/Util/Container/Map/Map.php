<?php
namespace Clio\Component\Util\Container\Map;

use Clio\Component\Util\Container\Storage;

/**
 * Map
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class Map extends AbstractMap 
{
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer($values);

		foreach($values as $key => $value) {
			$this->getStorage()->insertAt($key, $value);
		}
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
	public function getKeys()
	{
		return array_keys($this->toArray()); 
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getValues()
	{
		return array_values($this->toArray());
	}

	/**
	 * {@inheritdoc}
	 */
	public function has($key)
	{
		return $this->getStorage()->existsAt($key);
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
	public function remove($key)
	{
		$this->getStorage()->removeAt($key);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function set($key, $value)
	{
		$this->getStorage()->insertAt($key, $value);
		return $this;
	}

	public function replace(array $values)
	{
		$this->getStorage()->removeAll();

		foreach($values as $key => $value) {
			$this->set($key, $value);
		}
	}

	public function setStorage(Storage $storage)
	{
		if(!$storage instanceof Storage\RandomAccessable) {
			throw new \InvalidArgumentException('Map Storage has to be an RandomAccessable');
		}
		parent::setStorage($storage);
	}
}

