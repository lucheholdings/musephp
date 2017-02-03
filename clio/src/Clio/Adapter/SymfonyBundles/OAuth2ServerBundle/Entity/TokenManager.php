<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Doctrine\ORM\EntityManager;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\TokenInterface;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\TokenManager as BaseTokenManager;

/**
 * TokenManager 
 * 
 * @uses BaseTokenManager
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenManager extends BaseTokenManager
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
    public function findTokenBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    /**
     * {@inheritdoc}
     */
    public function updateToken(TokenInterface $token)
    {
        $this->em->persist($token);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteToken(TokenInterface $token)
    {
        $this->em->remove($token);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    function deleteExpired()
    {
        $qb = $this->repository->createQueryBuilder('t');
        $qb
            ->delete()
            ->where('t.expiresAt < ?1')
            ->setParameters(array(1 => time()));

        return $qb->getQuery()->execute();
    }
}
