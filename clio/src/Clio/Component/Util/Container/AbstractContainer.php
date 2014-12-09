<?php
namespace Clio\Component\Util\Container;

use Clio\Component\Util\Container\Storage\ValidatableStorage;
use Clio\Component\Util\Validator\Validator;

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

	public function merge($other)
	{
		if(!$other instanceof static) {
			throw new \RuntimeException('Container::merge has to be the same class');
		}

		return new static(array_merge($this->toArray(), $other->toArray()));
	}

	public function map(\Closure $callback)
	{
		$container = clone $this;
		$container->setStorage($this->getStorage()->map($callback));

		return $container;
	}
}

