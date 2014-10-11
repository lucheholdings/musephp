<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Doctrine\ORM\EntityManager;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ScopeManagerInterface;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ScopeInterface;

/**
 * ScopeManager 
 * 
 * @uses ScopeProviderStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ScopeManager implements ScopeManagerInterface 
{
	protected $em;

	protected $repository;

	protected $class;

	/**
	 * _scopes 
	 *   
	 * @var mixed
	 * @access protected
	 */
	protected $_scopes;

	public function __construct(EntityManager $em, $class)
	{
		$this->em = $em;
		$this->repository = $em->getRepository($class);
		$this->class = $this->em->getClassMetadata($class);
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
    
    public function getRepository()
    {
        return $this->repository;
    }
    
    public function setRepository($repository)
    {
        $this->repository = $repository;
        return $this;
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

	public function getScope($scope)
	{
		return $this->getRepository()->findOneBy(array('scope' => $scope));
	}

	public function getScopes(array $scopes = array())
	{
		if(empty($scopes)) {
			return $this->getRepository()->findBy(array());
		} else {
			return $this->getRepository()->findBy(array('scope' => $scopes));
		}
	}

	public function getSupportedScopes()
	{
		if(!$this->_scopes) {
			$this->_scopes = $this->getRepository()->findBy(array());
		}

		if(empty($this->_scopes)) {
			return array();
		}
		return array_map(function($scope) {
			return $scope->getScope();
		}, $this->_scopes);
	}

	public function getDefaultScopes()
	{
		$scopes = $this->getRepository()->findBy(array('isDefault' => true));
		if(empty($scopes)) {
			return array();
		}

		return array_map(function($scope) {
			return $scope->getScope();
		}, $scopes);
	}

	public function save(ScopeInterface $scope, $needFlush = true)
	{
		$this->getEntityManager()->persist($scope);

		if($needFlush) {
			$this->getEntityManager()->flush();
		}
	}

	public function flush()
	{
		$this->getEntityManager()->flush();
	}

	public function createScope()
	{
		return $this->getClass()->newInstance();
	}
}

