<?php
namespace ;

use Doctrine\Common\Collections\Collection;

/**
 * MapCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MapCollection implements Collection 
{
	/**
	 * has 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function has($element)
	{
		return $this->getReference()->contains($element);
	}

	/**
	 * hasKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasKey($key)
	{
		return $this->getReference()->containsKey($key);
	}

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	public function clear()
	{
		return $this->getReference()->clear();
	}

	/**
	 * contains 
	 * 
	 * @param mixed $element 
	 * @access public
	 * @return void
	 */
	public function contains($element)
	{
		return $this->getReference()->contains($element);
	}

	/**
	 * isEmpty 
	 * 
	 * @access public
	 * @return void
	 */
	public function isEmpty()
	{
		return $this->getReference()->isEmpty();
	}

	/**
	 * remove 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeByKey($key)
	{
		return $this->getReference()->remove($key);
	}

	/**
	 * removeElement
	 * 
	 * @param mixed $element 
	 * @access public
	 * @return void
	 */
	public function removeElement($element)
	{
		return $this->getReference()->removeElement($element);
	}

	/**
	 * remove 
	 * 
	 * @param mixed $element 
	 * @access public
	 * @return void
	 */
	public function remove($element)
	{
		return $this->removeElement($element);
	}

	/**
	 * containsKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function containsKey($key)
	{
		return $this->hasKey($key);
	}

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key)
	{
		return $this->getReference()->get($key);
	}

	/**
	 * getKeys 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKeys()
	{
		return $this->getReference()->getKeys();
	}

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return $this->getReference()->getValues();
	}

	/**
	 * add 
	 * 
	 * @param mixed $element 
	 * @access public
	 * @return void
	 */
	public function add($element)
	{
		$this->getReference()->add($element);

		return $element;
	}

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		$this->getReference()->set($key, $value);

		return $this;
	}

	/**
	 * toArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function toArray()
	{
		return $this->getReference()->toArray();
	}

	/**
	 * first 
	 * 
	 * @access public
	 * @return void
	 */
	public function first()
	{
		return $this->getReference()->first();
	}
	
	/**
	 * last 
	 * 
	 * @access public
	 * @return void
	 */
	public function last()
	{
		return $this->getReference()->last();
	}
	
	/**
	 * key 
	 * 
	 * @access public
	 * @return void
	 */
	public function key()
	{
		return $this->getReference()->key();
	}

	/**
	 * current 
	 * 
	 * @access public
	 * @return void
	 */
	public function current()
	{
		return $this->getReference()->current();
	}
	
	/**
	 * next 
	 * 
	 * @access public
	 * @return void
	 */
	public function next()
	{
		return $this->getReference()->next();
	}

	/**
	 * exists 
	 * 
	 * @param \Closure $p 
	 * @access public
	 * @return void
	 */
	public function exists(\Closure $p)
	{
		return $this->getReference()->exists($p);
	}

	/**
	 * filter 
	 * 
	 * @param \Closure $p 
	 * @access public
	 * @return void
	 */
	public function filter(\Closure $p)
	{
		return $this->getReference()->filter($p);
	}

	/**
	 * forAll 
	 * 
	 * @param \Closure $p 
	 * @access public
	 * @return void
	 */
	public function forAll(\Closure $p)
	{
		return $this->getReference()->forAll($p);
	}

    /**
     * map 
     * 
     * @param \Closure $func 
     * @access public
     * @return void
     */
    public function map(\Closure $func)
	{
		return $this->getReference()->map($func);
	}

    /**
     * partition 
     * 
     * @param \Closure $p 
     * @access public
     * @return void
     */
    public function partition(\Closure $p)
	{
		return $this->getReference()->partition($p);
	}

    /**
     * indexOf 
     * 
     * @param mixed $element 
     * @access public
     * @return void
     */
    public function indexOf($element)
	{
		return $this->getReference()->indexOf($element);
	}

    /**
     * slice 
     * 
     * @param mixed $offset 
     * @param mixed $length 
     * @access public
     * @return void
     */
    public function slice($offset, $length = null)
	{
		return $this->getReference()->slice($offset, $length);
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		return $this->getReference()->count();
	}

    /**
     * getIterator 
     * 
     * @access public
     * @return void
     */
    public function getIterator()
	{
		return $this->getReference()->getIterator();
	}

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return $this->hasKey($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
     * Required by interface ArrayAccess.
     *
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        return $this->removeByKey($offset);
    }

	/**
	 * getReference 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReference()
	{
		return $this->getDoctrineCollection();
	}

	/**
	 * getRaw 
	 * 
	 * @access public
	 * @return void
	 */
	public function getRaw()
	{
		return $this->getReference();
	}
}

