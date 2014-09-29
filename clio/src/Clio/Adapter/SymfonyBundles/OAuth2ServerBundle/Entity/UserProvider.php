<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Doctrine\ORM\EntityManager;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\UserInterface;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\UserProvider as BaseUserProvider;

use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;

class UserProvider extends BaseUserProvider
{
    /**
     * @var \Doctrine\Common\ObjectManager
     */
    protected $om;

    /**
     * @var \Doctrine\ORM\Repository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $class;

    public function __construct(EntityManager $om, $class)
    {
        $this->om = $om;
        $this->repository = $om->getRepository($class);
        $this->class = $class;
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
    public function findUserBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

	/**
	 * loadUserByUsername 
	 * 
	 * @param mixed $username 
	 * @access public
	 * @return void
	 */
	public function loadUserByUsername($username)
	{
        return $this->repository->findOneBy(array('username' => $username));
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadUserByProviderId($providerName, $id)
	{
		return $this->repository->findOneBy(array($providerName . '_id' => $id));
	}

	public function supportsClass($class)
	{
		$class = new \ReflectionClass($class);
		return $class->isSubclassOf($this->class);
	}

	public function refreshUser(SecurityUserInterface $user)
	{
		return $user;
	}
}
