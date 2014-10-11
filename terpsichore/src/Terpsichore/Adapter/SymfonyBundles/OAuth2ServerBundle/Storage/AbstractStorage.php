<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Util\StorageUtil;

/**
 * AbstractStorage 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractStorage
{
	/**
	 * util 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $util;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(StorageUtil $util = null)
	{
		$this->util = $util ? : new StorageUtil();
	}
    
    /**
     * Get util.
     *
     * @access public
     * @return util
     */
    public function getStorageUtil()
    {
        return $this->util;
    }
    
    /**
     * Set util.
     *
     * @access public
     * @param util the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setStorageUtil($util)
    {
        $this->util = $util;
        return $this;
    }
}

