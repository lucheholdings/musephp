<?php
namespace Calliope\Bridge\DoctrineCommon\Connection;

use Calliope\Core\Connection\Factory as ConnectionFactoryInterface,
	Calliope\Core\Connection\Factory\AbstractConnectionFactory
;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\Common\Persistence\ObjectManager,
	Doctrine\Common\Persistence\ObjectRepository
;

/**
 * ConnectionFactory 
 * 
 * @uses ConnectionFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ConnectionFactory extends AbstractConnectionFactory implements ConnectionFactoryInterface 
{
	const CONNECTION_CLASS = 'Calliope\Bridge\DoctrineCommon\Connection\Connection';
	/**
	 * doctrineRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $doctrineRegistry;

	/**
	 * __construct 
	 * 
	 * @param RegistryInterface $doctrineRegistry 
	 * @access public
	 * @return void
	 */
	public function __construct(RegistryInterface $doctrineRegistry)
	{
		$this->doctrineRegistry = $doctrineRegistry;
	}

	/**
	 * createConnection 
	 * 
	 * @access public
	 * @return void
	 */
	public function createConnection($connectTo, array $params = array())
	{
		// Create Reposiotry 
		if(is_string($connectTo)) {
			$connectTo = $this->getDoctrineRegistry()->getManager($connectTo);
		} else if(!$connectTo instanceof ObjectManager) {
			throw new \Exception('ConnectionFactory requires EntityManager for $connectTo.');
		}

		return $this->doCreateConnection($connectTo);
	}

	/**
	 * doCreateConnection 
	 * 
	 * @param ObjectManager $manager 
	 * @param ObjectRepository $repository 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doCreateConnection(ObjectManager $manager);
    
    /**
     * Get doctrineRegistry.
     *
     * @access public
     * @return doctrineRegistry
     */
    public function getDoctrineRegistry()
    {
        return $this->doctrineRegistry;
    }
    
    /**
     * Set doctrineRegistry.
     *
     * @access public
     * @param doctrineRegistry the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDoctrineRegistry(RegistryInterface $doctrineRegistry)
    {
        $this->doctrineRegistry = $doctrineRegistry;
        return $this;
    }
}

