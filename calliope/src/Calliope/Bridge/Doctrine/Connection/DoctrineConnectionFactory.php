<?php
namespace Calliope\Bridge\Doctrine\Connection;

use Calliope\Framework\Core\Connection\Factory\ConnectionFactoryInterface,
	Calliope\Framework\Core\Connection\Factory\AbstractConnectionFactory
;
use Symfony\Bridge\Doctrine\RegistryInterface;

use Doctrine\Common\Persistence\ObjectManager,
	Doctrine\Common\Persistence\ObjectRepository
;

/**
 * DoctrineConnectionFactory 
 * 
 * @uses ConnectionFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class DoctrineConnectionFactory extends AbstractConnectionFactory implements ConnectionFactoryInterface 
{
	const CONNECTION_CLASS = 'Calliope\Bridge\Doctrine\Connection\DoctrineConnection';
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
			$manager = $this->getDoctrineRegistry()->getManager($connectTo);
		} else if($connectTo instanceof ObjectManager) {
			$manager = $connectTo;
		} else {
			throw new \Exception('DoctrineConnectionFactory requires EntityManager for $connectTo.');
		}

		if(!isset($params['scheme_class'])) {
			throw new \Exception('DoctrineConnectionFactory requires "scheme_class" on $params');
		}

		return $this->doCreateConnection($manager, $manager->getRepository((string)$params['scheme_class']));
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
	abstract protected function doCreateConnection(ObjectManager $manager, ObjectRepository $repository);
    
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
    public function setDoctrineRegistry($doctrineRegistry)
    {
        $this->doctrineRegistry = $doctrineRegistry;
        return $this;
    }
}

