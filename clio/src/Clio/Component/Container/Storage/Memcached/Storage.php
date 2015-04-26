<?php
namespace Clio\Component\Container\Storage\Memcached;

use Clio\Component\Container\Storage as StorageInterface;

/**
 * Storage 
 * 
 * @uses StorageInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Storage implements StorageInterface
{
    /**
     * memcached 
     * 
     * @var mixed
     * @access private
     */
    private $memcached;

    /**
     * __construct 
     * 
     * @param \Memcached $memcached 
     * @access public
     * @return void
     */
    public function __construct(\Memcached $memcached = null)
    {
        $this->memcached = $memcached;
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
}

