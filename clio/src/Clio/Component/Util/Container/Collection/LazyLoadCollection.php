<?php
namespace Clio\Component\Util\Container\Collection;

/**
 * LazyLoadCollection 
 * 
 * @uses Collection
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class LazyLoadCollection extends ProxyCollection
{
	/**
	 * isLoaded 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $loaded;

	private $postLoadCallback;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->loaded = false;
	}

	/**
	 * initContainer 
	 *    
	 * @access protected
	 * @return void
	 */
	protected function initContainer()
	{
	}

	/**
	 * load 
	 * 
	 * @access public
	 * @return void
	 */
	public function load()
	{
		if(!$this->loaded) {
			$this->loaded = true;
			$this->_load();

			$collection = $this->getCollection();

			if($this->postLoadCallback) {
				$collection = $this->postLoadCallback->__invoke($collection);
			}
		}

		return $this->getCollection();
	}

	/**
	 * _load 
	 *   Override this function to implement LazyLoad Functionality
	 * @access protected
	 * @return void
	 */
	abstract protected function _load();

	/**
	 * isLoaded 
	 * 
	 * @access public
	 * @return void
	 */
	public function isLoaded()
	{
		return $this->loaded;
	}

	/**
	 * getCollection 
	 * 
	 * @access public
	 * @return void
	 */
	public function getCollection()
	{
		if(!parent::getCollection()) {
			// Load
			$this->_load();
		}

		return parent::getCollection();
	}
    
    /**
     * Get postLoadCallback.
     *
     * @access public
     * @return postLoadCallback
     */
    public function getPostLoadCallback()
    {
        return $this->postLoadCallback;
    }
    
    /**
     * Set postLoadCallback.
     *
     * @access public
     * @param postLoadCallback the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPostLoadCallback(\Closure $postLoadCallback)
    {
        $this->postLoadCallback = $postLoadCallback;
        return $this;
    }
}

