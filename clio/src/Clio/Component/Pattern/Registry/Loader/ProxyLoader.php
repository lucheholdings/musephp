<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Pattern\EntryLoader;
/**
 * ProxyLoader 
 * 
 * @uses EntryLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ProxyLoader implements EntryLoader 
{
	/**
	 * loader 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $loader;

	/**
	 * __construct 
	 * 
	 * @param EntryLoader $loader 
	 * @access public
	 * @return void
	 */
	public function __construct(EntryLoader $loader)
	{
		$this->loader = $loader;
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadEntry($key)
	{
		return $this->getLoader()->loadEntry($key);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canLoad($key)
	{
		return $this->getLoader()->canLoad($key);
	}
    
    /**
     * getLoader 
     * 
     * @access public
     * @return void
     */
    public function getLoader()
    {
        return $this->loader;
    }
    
    /**
     * setLoader 
     * 
     * @param mixed $loader 
     * @access public
     * @return void
     */
    public function setLoader($loader)
    {
        $this->loader = $loader;
        return $this;
    }
}

