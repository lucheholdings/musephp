<?php
namespace Calliope\Framework\Core\Connection;

use Calliope\Framework\Core\SchemeRegistryInterface;

/**
 * LazyBindProxyManagerConnection 
 * 
 * @uses ProxyManagerConnection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LazyBindProxyManagerConnection extends ProxyManagerConnection 
{
	/**
	 * registry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $registry;

	/**
	 * connectName 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $connectName;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemeRegistryInterface $registry, $connectName, array $options = array())
	{
		parent::__construct(null, $options);

		$this->registry = $registry;
		$this->connectName = $connectName;
	}

	/**
	 * getConnectTo 
	 * 
	 * @access public
	 * @return void
	 */
	public function getConnectTo()
	{
		$connectTo = parent::getConnectTo();
		
		if(!$connectTo) {
			$connectTo = $this->getRegistry()->getSchemeManager(
				$this->getConnectName()
			);

			$this->setConnectTo($connectTo);
		}

		return $connectTo;
	}
    
    /**
     * Get registry.
     *
     * @access public
     * @return registry
     */
    public function getRegistry()
    {
        return $this->registry;
    }
    
    /**
     * Set registry.
     *
     * @access public
     * @param registry the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setRegistry($registry)
    {
        $this->registry = $registry;
        return $this;
    }
    
    /**
     * Get connectName.
     *
     * @access public
     * @return connectName
     */
    public function getConnectName()
    {
        return $this->connectName;
    }
    
    /**
     * Set connectName.
     *
     * @access public
     * @param connectName the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConnectName($connectName)
    {
        $this->connectName = $connectName;
        return $this;
    }
}

