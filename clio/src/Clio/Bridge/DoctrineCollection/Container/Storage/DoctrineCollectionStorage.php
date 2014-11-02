<?php
namespace Clio\Bridge\DoctrineCollection\Container\Storage;

use Clio\Component\Util\Container\Storage;
use Doctrine\Common\Collections\Collection as DoctrineCollection;

/**
 * DoctrineCollectionStorage 
 * 
 * @uses ProxyStorage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineCollectionStorage implements Storage, Storage\RandomAccessable, Storage\SetAccessable
{
	private $source;

	/**
	 * __construct 
	 * 
	 * @param DoctrineCollection $collection 
	 * @access public
	 * @return void
	 */
	public function __construct(DoctrineCollection $collection)
	{
		$this->source = $collection;
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
		$this->getSource()->clear();
	}

	// SetAccessable
	public function insert($value)
	{
		$this->getSource()->add($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function exists($value)
	{
		return $this->getSource()->contains($value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function remove($value)
	{
		$this->getSource()->removeElement($value);
	}

	// RandomAccessable Methods
	/**
	 * {@inheritdoc}
	 */
	public function existsAt($key)
    {
		return $this->getSource()->containsKey($key);
    }

	/**
	 * {@inheritdoc}
	 */
	public function getAt($key)
	{
		return $this->getSource()->get($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function insertAt($key, $value)
	{
		$this->getSource()->set($key, $value);
	}

	/**
	 * {@inheritdoc}
	 */
	public function removeAt($key)
	{
		$this->getSource()->remove($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIterator($mode = self::ITERATE_FORWARD)
	{
		switch($mode) {
		case 'FIFO':
		case 'FORWARD':
			return $this->getSource()->getIterator($mode);
		default:
			throw new UnsupportedException(sprintf('Iteration mode "%d" is not supported by %s', $mode, __CLASS__));
		}
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
    
    public function setSource(DoctrineCollection $source)
    {
        $this->source = $source;
        return $this;
    }
}

