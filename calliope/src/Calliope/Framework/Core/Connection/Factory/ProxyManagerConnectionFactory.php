<?php
namespace Calliope\Framework\Core\Connection\Factory;

use Calliope\Framework\Core\SchemeRegistryInterface;
use Calliope\Framework\Core\SchemeManagerInterface;

use Calliope\Framework\Core\Connection\LazyBindProxyManagerConnection;

/**
 * ProxyManagerConnectionFactory 
 * 
 * @uses ConnectionFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyManagerConnectionFactory extends AbstractConnectionFactory implements ConnectionFactoryInterface 
{
	/**
	 * registry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $registry;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemeRegistryInterface $registry)
	{
		$this->registry = $registry;
	}

	/**
	 * create 
	 * 
	 * @param mixed $connectTo 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function createConnection($connectTo, array $params = array())
	{
		$connection = null;
		if(is_string($connectTo)) {
			if($this->getRegistry()->hasAlias($connectTo)) {
				$connection = new LazyBindProxyManagerConnection(
					$this->getRegistry(),
					$connectTo
				);
			} else {
				throw new \RuntimeException(sprintf(
					'SchemeManager for "%s" is not registered on SchemeManagerRegistry.',
					$connectTo
				));
			}
		} else if($connectTo instanceof SchemeManagerInterface) {
			$connection = new ProxyManagerConnection($connectTo);
		}

		if(!$connection) {
			throw new \Exception('Failed to create a connection for SchemeManager Proxy.');
		}

		return $connection;
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
    public function setRegistry(SchemeRegistryInteface $registry)
    {
        $this->registry = $registry;
        return $this;
    }
}

