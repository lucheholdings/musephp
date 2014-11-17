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

	private $postLoadCallbacks = array();

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
	 * init 
	 *    
	 * @access protected
	 * @return void
	 */
	protected function init()
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

			if(!empty($this->postLoadCallbacks)) {
				while($callback = array_shift($this->postLoadCallbacks)) {
					$collection = $callback->__invoke($collection);
				}
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
    public function getPostLoadCallbacks()
    {
        return $this->postLoadCallbacks;
    }
    
    /**
     * Set postLoadCallback.
     *
     * @access public
     * @param postLoadCallback the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function addPostLoadCallback(\Closure $postLoadCallback)
    {
        $this->postLoadCallbacks[] = $postLoadCallback;
        return $this;
    }

	public function filter(\Closure $closure)
	{
		if($this->isLoaded()) {
			parent::filter($closure);
		} else {
			$this->addPostLoadCallback(function($collection) use ($closure){
				$collection->filter($closure);
			});
		}
	}

	public function map(\Closure $closure)
	{
		if($this->isLoaded()) {
			parent::map($closure);
		} else {
			$this->addPostLoadCallback(function($collection) use ($closure) {
				$collection->map($closure);
			});
		}
	}

}

