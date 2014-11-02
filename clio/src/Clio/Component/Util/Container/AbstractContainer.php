<?php
namespace Clio\Component\Util\Container;

use Clio\Component\Util\Container\Storage\ValidatableStorage;

/**
 * AbstractContainer 
 * 
 * @uses Container
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractContainer implements Container
{
	/**
	 * {@inheritdoc}
	 */
	protected $storage;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(array $values = array(), Storage $storage = null)
	{
		$this->storage = $storage;

		$this->initContainer($values);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $values)
	{
		if(!$this->storage) {
			$this->storage = new Storage\ArrayStorage();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function clear()
	{
		$this->storage->removeAll();
	}

	/**
	 * {@inheritdoc}
	 */
	public function toArray()
	{
		return $this->storage->toArray();
	}

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return array_values($this->toArray());
	}

	/**
	 * {@inheritdoc}
	 */
	public function getStorage()
	{
		return $this->storage;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setStorage(Storage $storage)
	{
		$this->storage = $storage;
		return $this;
	}

	public function getIterator()
	{
		return $this->getStorage()->getIterator();
	}

	public function count()
	{
		if(!$this->storage instanceof \Countable) {
			throw new \RuntimeException('Storage is not countable.');
		}
		return $this->storage->count();
	}

	/**
	 * {@inheritdoc}
	 */
	public function serialize()
	{
		if(!$this->storage instanceof \Serializable) {
			throw new \RuntimeException('Container storage is not serializable.');
		}

		return serialize(array(
			$this->storage
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$data = unserialize($serialized);

		list(
			$this->storage
		) = $data;
	}

	public function enableStorageValidation()
	{
		if(!$this->storage instanceof ValidatableStorage) {
			$this->storage = new ValidatableStorage($this->storage);
		}
	}

	public function disableStorageValidation()
	{
		if($this->storage instanceof ValidatableStorage) {
			$this->storage = $this->storage->getSource();
		}
	}
}

