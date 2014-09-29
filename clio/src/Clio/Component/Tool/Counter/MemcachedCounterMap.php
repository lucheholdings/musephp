<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\Tool\Counter;

/**
 * MemcachedCounterMap 
 * 
 * @uses CounterMap
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MemcachedCounterMap implements CounterMap 
{
	/**
	 * memcached 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $memcached;

	private $ns;

	/**
	 * __construct 
	 * 
	 * @param \Memcached $memcached 
	 * @access public
	 * @return void
	 */
	public function __construct(\Memcached $memcached, $ns = null)
	{
		$this->memcached = $memcached;
		$this->ns = $ns;
	}

	/**
	 * count 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function count($key = null)
	{
		return (int)$this->memcached->get($this->getNamespacedName($key));
	}

	/**
	 * reset 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function reset($key = null)
	{
		$this->memcached->set($this->getNamespacedName($key), 0);

		return $this;
	}

	/**
	 * increment 
	 * 
	 * @param mixed $key 
	 * @param int $num 
	 * @access public
	 * @return void
	 */
	public function increment($key = null, $num = 1)
	{
		$retVal = $this->memcached->get($this->getNamespacedName($key));
		if(false === $retVal) {
			if($this->memcached->getResultCode() == \Memcached::RES_NOTFOUND) {
				$this->reset($key);
			} else {
				throw new \RuntimeException(sprintf('Memcached Error : "%s"', $this->memcached->getResultMessage()));
			}
		}

		$retVal = $this->memcached->increment($this->getNamespacedName($key), $num);

		if(false === $retVal) {
			throw new \RuntimeException(sprintf('Failed to increment value "%s" : "%s"', $this->getNamespacedName($key), $this->memcached->getResultMessage()));
		}
		return $this;
	}

	/**
	 * decrement 
	 * 
	 * @param mixed $key 
	 * @param int $num 
	 * @access public
	 * @return void
	 */
	public function decrement($key = null, $num = 1)
	{
		$retVal = $this->memcached->get($this->getNamespacedName($key));
		if(false === $retVal) {
			if($this->memcached->getResultCode() == \Memcached::RES_NOTFOUND) {
				$this->reset($key);
			} else {
				throw new \RuntimeException(sprintf('Memcached Error : "%s"', $this->memcached->getResultMessage()));
			}
		}
		$retVal = $this->memcached->decrement($this->getNamespacedName($key), $num);

		if(false === $retVal) {
			throw new \RuntimeException(sprintf('Failed to decrement value "%s" : "%s"', $this->getNamespacedName($key), $this->memcached->getResultMessage()));
		}
		return $this;
	}
    
    /**
     * getMemcached 
     * 
     * @access public
     * @return void
     */
    public function getMemcached()
    {
        return $this->memcached;
    }
    
    /**
     * setMemcached 
     * 
     * @param \Memcached $memcached 
     * @access public
     * @return void
     */
    public function setMemcached(\Memcached $memcached)
    {
        $this->memcached = $memcached;
        return $this;
    }
    
    /**
     * getNamespace 
     * 
     * @access public
     * @return void
     */
    public function getNamespace()
    {
        return $this->ns;
    }
    
    /**
     * setNamespace 
     * 
     * @param mixed $ns 
     * @access public
     * @return void
     */
    public function setNamespace($ns)
    {
        $this->ns = $ns;
        return $this;
    }

	/**
	 * getNamespacedName 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getNamespacedName($key = null)
	{
		if(!$key) {
			throw new \InvalidArgumentException('Key has to be specified.');
		}

		if($ns = $this->getNamespace())  {
			return sprintf('%s[%s]', $this->getNamespace(), $key);
		}

		return $key;
	}
}

