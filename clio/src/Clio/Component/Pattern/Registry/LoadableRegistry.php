<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Pattern\Loader\Loader;
use Clio\Component\Pattern\Loader\Exception as LoaderException;

/**
 * LoadableRegistry 
 * 
 * @uses Registry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LoadableRegistry extends ProxyRegistry 
{
	/**
	 * loader 
	 * 
	 * @var array
	 * @access private
	 */
	private $loader = array();

    /**
     * loadings 
     * 
     * @var array
     * @access private
     */
    private $loadings = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(Loader $loader = null, Registry $registry = null)
	{
		if(!$registry) {
			$registry = new MapRegistry();
		}
		parent::__construct($registry);

		$this->loader = $loader;
	}

    /**
     * isLoaded 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function isLoaded($key)
	{
		return $this->getRegistry()->has($key);
	}

    /**
     * load 
     * 
     * @param mixed $key 
     * @param array $options 
     * @access public
     * @return void
     */
	public function load($key, array $options = array())
	{
        $key = (string)$key;
		$loaded = null;
		// Load for the key
        if(isset($this->loadings[$key])) {
            throw new LoaderException\CircularException(sprintf('CircularException is occured. "%s" is on loading process.', (string)$key));
        } else if($this->loader) {

            $this->loadings[$key] = true;
            try {
                //
			    $loaded = $this->loader->load($key, $options);

                $this->set($key, $loaded);
                unset($this->loadings[$key]);
            } catch(\Exception $ex) {
                unset($this->loadings[$key]);
                throw $ex;
            }
		} else {
            throw new \InvalidArgumentException('Loader is not initialized');
        }

		return $loaded;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($key)
	{
        $key = (string)$key;
		if(!$this->isLoaded($key)) {
			$loaded = $this->load($key, array(), false);
		}
        
        try {
		    return $this->getRegistry()->get($key);
        } catch(\Exception $ex) {
            throw new Exception\NotRegisteredException(sprintf('"%s" is not registered.', $key), 0, $ex);
        }
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
        $key = (string)$key;
		if($this->getRegistry()->has($key)) {
			return true;
		}

		// try load 
        try {
		    $this->load($key);
            return true;
        } catch(LoaderException $ex) {
            // Do not throw
            throw new LoaderException\Failure(sprintf('Failed to load resource "%s".', $key), 0, $ex);
        }

		return false;
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
	 * @param Loader $loader 
	 * @access public
	 * @return void
	 */
	public function setLoader(Loader $loader)
	{
		$this->loader = $loader;
	}
}

