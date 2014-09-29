<?php

/*
 * This file is part of the ClioOAuth2ServerBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Doctrine\ORM\EntityManager;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientInterface;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientProvider as BaseClientProvider;

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

	public function findOneByClientId($clientId)
	{
		return $this->findClientBy(array('clientId' => $clientId));
	}
}
