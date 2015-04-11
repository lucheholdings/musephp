<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Connection;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityRepository;

use
	Calliope\Core\Connection\Factory,
	Calliope\Core\Connection\Factory\AbstractConnectionFactory
;
use Calliope\Bridge\Doctrine\Connection\DoctrineOrmConnection; 

/**
 * DoctrineRepositoryConnectionFactory 
 * 
 * @uses AbstractConnectionFactory
 * @uses ConnectionFactoryInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineRepositoryConnectionFactory extends AbstractConnectionFactory implements Factory
{
	/**
	 * container 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $container;

	/**
	 * __construct 
	 * 
	 * @param ContainerInterface $container 
	 * @access public
	 * @return void
	 */
	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}

	/**
	 * createConnection 
	 * 
	 * @param mixed $connectTo 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function createConnection($connectTo, array $params = array())
	{
		$repository = $this->getContainer()->get($connectTo);

		if($repository instanceof EntityRepository) {
			$manager = $repository->getEntityManager();
			$connection = new DoctrineOrmConnection($manager, $repository, isset($params['options']) ? $params['options'] : array());
		} else {
			throw new \InvalidArgumentException('DoctrineOrmRepositoryConnectionFactory only accept ObjectRepository.');
		}
		
		return $connection;
	}
    
    /**
     * Get container.
     *
     * @access public
     * @return container
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * Set container.
     *
     * @access public
     * @param container the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }
}

