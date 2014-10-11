<?php

/*
 * This file is part of the TerpsichoreOAuth2ServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Doctrine\ORM\EntityManager;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientInterface;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientProvider as BaseClientProvider;

/**
 * ClientProvider 
 * 
 * @uses BaseClientProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientProvider extends BaseClientProvider 
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
    public function findClientBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

	/**
	 * findOneByClientId 
	 * 
	 * @param mixed $clientId 
	 * @access public
	 * @return void
	 */
	public function findOneByClientId($clientId)
	{
		return $this->findClientBy(array('clientId' => $clientId));
	}
}
