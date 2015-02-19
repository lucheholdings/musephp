<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;
use Clio\Component\Util\Container\AbstractContainer;

abstract class StorageContainer extends AbstractContainer
{
	/**
	 * {@inheritdoc}
	 */
	protected $storage;

	public function __construct(array $defaults = array(), Storage $storage = null)
	{
		$this->storage = $storage;

		parent::__construct($defaults);
	}

	protected function initContainer(array $defaults)
	{
		if(!$this->storage) 
			$this->storage = new ArrayStorage($defaults);
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
		return $this;
	}

	public function disableStorageValidation()
	{
		if($this->storage instanceof ValidatableStorage) {
			$this->storage = $this->storage->getSource();
		}
		return $this;
	}

	public function setValueValidator(Validator $validator) 
	{
		$this->enableStorageValidation();

		$this->storage->setValueValidator($validator);
		return $this;
	}

	public function setKeyValidator(Validator $validator)
	{
		$this->enableStorageValidation();

		$this->storage->setKeyValidator($validator);
		return $this;
	}

	public function filter(\Closure $callable)
	{
		$container = clone $this;
		$container->setStorage($this->getStorage()->filter($callable));

		return $container;
	}

	public function map(\Closure $callback)
	{
		$container = clone $this;
		$container->setStorage($this->getStorage()->map($callback));

		return $container;
	}
}

