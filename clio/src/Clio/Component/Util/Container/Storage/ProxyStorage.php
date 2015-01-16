<?php
namespace Clio\Component\Util\Container\Storage;

use Clio\Component\Util\Container\Storage;
use Clio\Component\Exception as Exceptions;

class ProxyStorage implements SequencialAccessable, SetAccessable, RandomAccessable, \Countable, \Serializable
{
	private $source;

	public function __construct(Storage $source)
	{
		$this->source = $source;
	}

	public function getRaw()
	{
		return $this->getSource()->getRaw();
	}

	// Storage Methods
	/**
	 * {@inheritdoc}
	 */
	public function toArray()
	{
		return $this->getSource()->toArray();
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeAll()
	{
		$this->getSource()->removeAll();
	}

	// SetAccessable
	public function insert($value)
	{
		$storage = $this->getSource();
		if(!$storage instanceof SetAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SetAccessable.', get_class($this->getSource())));
		}
		$storage->insert($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function exists($value)
	{
		$storage = $this->getSource();
		if(!$storage instanceof SetAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SetAccessable.', get_class($this->getSource())));
		}
		return $storage->exists($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($value)
	{
		$storage = $this->getSource();
		if(!$storage instanceof SetAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SetAccessable.', get_class($this->getSource())));
		}
		return $storage->remove($value);
	}

	// SequencialAccessable Methods
	/**
	 * {@inheritdoc}
	 */
	public function insertBegin($value)
	{
		$storage = $this->getSource();
		if(!$storage instanceof SequencialAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SequencialAccessable.', get_class($this->getSource())));
		}
		return $storage->insertBegin($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertEnd($value)
	{
		$storage = $this->getSource();
		if(!$storage instanceof SequencialAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SequencialAccessable.', get_class($this->getSource())));
		}
		return $storage->insertEnd($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function begin()
	{
		$storage = $this->getSource();
		if(!$storage instanceof SequencialAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SequencialAccessable.', get_class($this->getSource())));
		}
		return $storage->begin();
	}

	/**
	 * {@inheritdoc}
	 */
	public function end()
	{
		$storage = $this->getSource();
		if(!$storage instanceof SequencialAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SequencialAccessable.', get_class($this->getSource())));
		}
		return $storage->end();
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeBegin()
	{
		$storage = $this->getSource();
		if(!$storage instanceof SequencialAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SequencialAccessable.', get_class($this->getSource())));
		}
		return $storage->removeBegin();
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function removeEnd()
	{
		$storage = $this->getSource();
		if(!$storage instanceof SequencialAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented SequencialAccessable.', get_class($this->getSource())));
		}
		return $storage->removeEnd();
	}

	// RandomAccessable Methods
	/**
	 * {@inheritdoc}
	 */
	public function existsAt($key)
    {
		$storage = $this->getSource();
		if(!$storage instanceof RandomAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented RandomAccessable.', get_class($this->getSource())));
		}
		return $storage->existsAt($key);
    }

	/**
	 * {@inheritdoc}
	 */
	public function getAt($key)
	{
		$storage = $this->getSource();
		if(!$storage instanceof RandomAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented RandomAccessable.', get_class($this->getSource())));
		}
		return $storage->getAt($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertAt($key, $value)
	{
		$storage = $this->getSource();
		if(!$storage instanceof RandomAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented RandomAccessable.', get_class($this->getSource())));
		}
		return $storage->insertAt($key, $value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeAt($key)
	{
		$storage = $this->getSource();
		if(!$storage instanceof RandomAccessable) {
			throw new Exceptions\UnsupportedException(sprintf('Source storage "%s" is not implemented RandomAccessable.', get_class($this->getSource())));
		}
		return $storage->removeAt($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIterator($mode = self::ITERATE_FORWARD)
	{
		return $this->getSource()->getIterator($mode);
	}

	/**
	 * {@inheritdoc}
	 */
	public function serialize()
	{
		return $this->getSource()->serialize($this->getSource());
	}

	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$storage = unserialize($serialized);

		$this->source = $storage;
	}
    
    public function getSource()
    {
        return $this->source;
    }
    
    public function setSource(Storage $source)
    {
        $this->source = $source;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function count()
	{
		if(!$this->getSource() instanceof \Countable) {
			throw new \RuntimeException('Storage is not a Countable.');
		}

		return count($this->getSource());
	}
}

