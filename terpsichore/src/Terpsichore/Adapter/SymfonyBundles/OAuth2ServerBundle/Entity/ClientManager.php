<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Doctrine\ORM\EntityManager;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientInterface;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientManagerInterface;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientProvider as BaseClientProvider;

/**
 * ClientManager 
 * 
 * @uses BaseClientManager
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientManager extends BaseClientProvider implements ClientManagerInterface 
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    /**
     * __construct 
     * 
     * @param EntityManager $em 
     * @param mixed $class 
     * @access public
     * @return void
     */
    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $this->class = $em->getClassMetadata($class);
    }

    /**
     * {@inheritdoc}
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * {@inheritdoc}
     */
    public function getClientBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

	public function getClientByName($name)
	{
		return $this->getClientBy(array('name' => $name));
	}

	/**
	 * findOneByClientId 
	 * 
	 * @param mixed $clientId 
	 * @access public
	 * @return void
	 */
	public function getClient($clientId)
	{
		return $this->getClientBy(array('clientId' => $clientId));
	}

	public function createClient()
	{
		return $this->getClass()->getReflectionClass()->newInstance();
	}

	public function save(ClientInterface $client, $needFlush = true)
	{
		$this->getEntityManager()->persist($client);
		if($needFlush) {
			$this->getEntityManager()->flush();
		}
	}

	public function flush()
	{
		$this->getEntityManager()->flush();
	}
    
    public function getEntityManager()
    {
        return $this->em;
    }
    
    public function setEntityManager($em)
    {
        $this->em = $em;
        return $this;
    }
}
