<?php
namespace Clio\Component\Util\Container\Storage\Memcached;

use Clio\Component\Util\Container\Storage\RandomAccessStorage;
use Clio\Component\Util\Container\Storage\Dumpable;
/**
 * RandomAccessStorage 
 * 
 * @uses RandomAccessStorage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MemcachedStorage implements RandomAccessStorage, Dumpable
{
	/**
	 * memcached 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $memcached;

	/**
	 * options
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(\Memcached $memcached, array $options = array())
	{
		$this->memcached = $memcached;
		$this->options = $options;
	}
     
     /**
      * Get memcached.
      *
      * @access public
      * @return memcached
      */
     public function getMemcached()
     {
         return $this->memcached;
     }
    
    /**
     * Get namespace.
     *
     * @access public
     * @return namespace
     */
    public function getNamespace()
    {
        return $this->options['namespace'];
    }
    
    /**
     * Set namespace.
     *
     * @access public
     * @param namespace the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setNamespace($namespace)
    {
        $this->options['namespace'] = $namespace;
        return $this;
    }

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
	}

	/**
	 * save 
	 * 
	 * @access public
	 * @return void
	 */
	public function save()
	{
	}

	/**
	 * count 
	 * 
	 * @access public
	 * @return void
	 */
	public function count()
	{
		// 
		throw new \Clio\Component\Exception\RuntimeException('Memcached RandomAccessStorage');
	}


	/**
	 * setAt 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setAt($key, $value)
	{
		if(!$this->memcached->set($this->getNamespacedName($key), $value)) {
			throw new \Clio\Component\Exception\RuntimeException(sprintf('Failed to set "%s" on memcached.', $key));		
		}
	}

	/**
	 * getAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getAt($key)
	{
		$retVal = $this->memcached->get($this->getNamespacedName($key));

		if(false === $retVal) {
			$code = $this->memcached->getResultCode();
			if(\Memcached::RES_NOTFOUND == $code) {
				$this->reset($key);
			} else if(\Memcached::RES_SUCCESS != $code) {
				throw new \RuntimeException(sprintf('Memcached Error : "%s"', $this->memcached->getResultMessage()));
			}
		}

		return $retVal;
	}

	/**
	 * removeAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeAt($key)
	{
		$this->memcached->delete($this->getNamespacedName($key));
		return $this;
	}

	/**
	 * existsAt 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function existsAt($key)
	{
		$retVal = $this->memcached->get($this->getNamespacedName($key));

		if((false === $retVal) && (\Memcached::RES_NOTFOUND == $this->memcached->getResultCode())) {
			return false;
		}
		return true;
	}

	/**
	 * getNamespacedName 
	 * 
	 * @param mixed $name 
	 * @access protected
	 * @return void
	 */
	protected function getNamespacedName($name)
	{
		if(isset($this->options['namespace'])) {
			return sprintf('%s.%s', $this->options['namespace'], $name);
		} 
		return $name;
	}

	protected function getNameWithoutNamespace($name)
	{
		if(isset($this->options['namespace'])) {
			$match = array();
			if(!preg_match("/^{$this->options['namespace']}\.(.*)/", $name, $match)) {
				throw new \InvalidArgumentException('Invalid Key');
			}
			$name = $match[1];
		}

		return $name;
	}

	public function dump()
	{
		$keys = $this->memcached->getAllKeys();
		$ns   = $this->getNamespace();

		if($ns) {
			$keys = array_filter($keys, function($key) use ($ns) {
				return preg_match("/^$ns\./", $key);
			});
		}

		$values = array();
		foreach($keys as $key) {
			$values[$this->getNameWithoutNamespace($key)] = $this->memcached->get($key);
		}

		return $values;
	}
}

