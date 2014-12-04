<?php
namespace Calliope\Core\Connection\Factory;

use Calliope\Core\Connection\Factory;
use Calliope\Core\SchemaRegistry;
use Calliope\Core\SchemaManagerInterface;

use Calliope\Core\Connection\UsecaseConnection;

/**
 * UsecaseConnectionFactory 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class UsecaseConnectionFactory extends AbstractConnectionFactory implements Factory 
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
	public function __construct(SchemaRegistry $registry)
	{
		$this->registry = $registry;
	}

	/**
	 * create 
	 * 
	 * @param string $connectTo 
	 * @param array $options
	 * @access public
	 * @return void
	 */
	public function createConnection($connectTo, array $options = array())
	{
		$connection = new UsecaseConnection($this->getRegistry(), $connectTo, $options);

		if(!$connection) {
			throw new \Exception('Failed to create a connection for SchemaManager Proxy.');
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
    public function setRegistry(SchemaRegistryInteface $registry)
    {
        $this->registry = $registry;
        return $this;
    }
}

