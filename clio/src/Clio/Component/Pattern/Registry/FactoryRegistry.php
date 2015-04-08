<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Pattern\Factory\MappedFactory;

/**
 * FactoryRegistry 
 * 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FactoryRegistry implements Registry 
{
    /**
     * factory 
     * 
     * @var mixed
     * @access private
     */
    private $factory;

    /**
     * entries 
     * 
     * @var mixed
     * @access private
     */
    private $entries;

    /**
     * __construct 
     * 
     * @param MappedFactory $factory 
     * @access public
     * @return void
     */
    public function __construct(MappedFactory $factory)
    {
        $this->factory = $factory;
        $this->entries = array();
    }

    /**
     * has 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function has($key)
    {
        return isset($this->entries[$key]);
    }

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return mixed|null 
	 */
	public function get($key)
    {
        if(!isset($this->entries[$key])) {
            $this->entries[$key] = $this->factory->createByKey($key);
        }
        return $this->entries[$key];
    }

	/**
	 * set
	 * 
	 * @param mixed $key 
	 * @param mixed $entry 
	 * @access public
	 * @return void
	 */
	public function set($key, $entry)
    {
        throw new \RuntimeException('FactoryRegistry cannot set ');
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
        unset($this->entries[$key]);
        return $this;
    }

	/**
	 * clear 
	 * 
	 * @access public
	 * @return void
	 */
	public function clear()
    {
        $this->entries  = array();
    }

	/**
	 * count 
	 *   Count already created. 
	 * @access public
	 * @return void
	 */
	public function count()
    {
        return count($this->entries);
    }
    
    public function getFactory()
    {
        return $this->factory;
    }
    
    public function setFactory(MappedFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }
}

