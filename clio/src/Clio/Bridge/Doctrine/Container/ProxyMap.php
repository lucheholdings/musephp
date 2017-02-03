<?php
namespace Clio\Bridge\Doctrine\Container;

use Clio\Component\Util\Container\Map;

/**
 * ProxyMap 
 * 
 * @uses ProxyCollection
 * @uses Map
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyMap extends AbstractProxyContainer implements Map 
{
    /**
     * toArray 
     * 
     * @access public
     * @return void
     */
    public function toArray()
    {
        return $this->getDoctrineCollection()->toArray();
    }

    /**
     * clear 
     * 
     * @access public
     * @return void
     */
    public function clear()
    {
        return $this->getDoctrineCollection()->clear();
    }

    /**
     * getValues 
     * 
     * @access public
     * @return void
     */
    public function getValues()
    {
        return $this->getDoctrineCollection()->map(function($element){
			return $element->getValue();
		});
    }

    // AliasedMap Functionalities
    /**
     * hasKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function hasKey($key)
    {
        return $this->getDoctrineCollection()->containsKey($key);
    }

    /**
     * set 
     * 
     * @param mixed $key 
     * @param mixed $vlaue 
     * @access public
     * @return void
     */
    public function set($key, $value)
    {
        $this->getDoctrineCollection()->set($key, $value);
    }

    /**
     * getKeys 
     * 
     * @access public
     * @return void
     */
    public function getKeys()
    {
        return $this->getDoctrineCollection()->getKeys();
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
        return $this->getDoctrineCollection()->get($key);
    }

    /**
     * remove 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function remove($key)
    {
        return $this->getDoctrineCollection()->remove($key);
    }

	/**
	 * remove 
	 * 
	 * @param mixed $element 
	 * @access public
	 * @return void
	 */
	public function removeElement($element)
	{
		return $this->getDoctrineCollection()->removeElement($element);
	}

    /**
     * getKeyValueArray 
     * 
     * @access public
     * @return void
     */
    public function getKeyValueArray()
    {
        $pairs = array();
        foreach($this as $attr) {
            $pairs[$attr->getKey()] = $attr->getValue();
        }
        return $pairs;
    }

	/**
	 * offsetExists 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetExists($key)
	{
		return $this->hasKey($key);
	}

	/**
	 * offsetGet 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetGet($key)
	{
		return $this->get($key);
	}

	/**
	 * offsetSet 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function offsetSet($key, $value)
	{
		$this->set($key, $value);
	}

	/**
	 * offsetUnset 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function offsetUnset($key)
	{
		return $this->removeByKey($key);
	}

}
