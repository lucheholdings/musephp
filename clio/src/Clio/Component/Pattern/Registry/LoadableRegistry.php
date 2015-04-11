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
			$registry = new RegistryMap();
		}
		parent::__construct($registry);

		$this->loader = $loader;
        $this->loader->setRegistry($this);
	}

	public function isLoaded($key)
	{
		return $this->getRegistry()->has($key);
	}

	public function load($key, array $options = array(), $canIncomplete = true)
	{
		$loaded = null;
		// Load for the key
        if(array_key_exists($this->loadings, $key)) {
            if($canIncomplete) {
                return $this->loadings[$key];
            }
            throw new CircularException(sprintf('CircularException is occured. "%s" is on loading process.', (string)$key));
        } else if($this->loader && $this->loader->canLoad($key)) {
            // first set loadings false, cause loaded is not yet instantiated 
            $this->loadings[$key] = false;
            //
			$loaded = $this->loader->load($key, $options);

            $this->loadings[$key] = $loaded;

            if($warmer = $this->getWarmer()) {
                $loaded = $warmer->warm($loaded);
            }

		} else {
            throw new \InvalidArgumentException(sprintf('"%s" cannot load.', $key));
        }

        // register all loading loaded into the registry.
        foreach($this->loadings as $loading) {
            $this->set($key, $loaded);
        }
        $this->loadings = array();
		
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

