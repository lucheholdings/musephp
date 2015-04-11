<?php
namespace Clio\Component\Pattern\Registry;

use Clio\Component\Pattern\Loader\Loader;

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
		$loaded = null;
		// Load for the key
        if(isset($this->loadings[$key])) {
            throw new CircularException(sprintf('CircularException is occured. "%s" is on loading process.', (string)$key));
        } else if($this->loader && $this->loader->canLoad($key)) {

            $this->loadings[$key] = true;
            //
			$loaded = $this->loader->load($key, $options);

            $this->set($key, $loaded);
            unset($this->loadings[$key]);
		} else {
            throw new \InvalidArgumentException(sprintf('"%s" cannot load.', $key));
        }

		return $loaded;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($key)
	{
		if(!$this->isLoaded($key)) {
			$loaded = $this->load($key, array(), false);
		}

		return $this->getRegistry()->get($key);
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
		if($this->getRegistry()->has($key)) {
			return true;
		}

		// 
		if($this->loader) 
            return $this->loader->canLoad($key);

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

