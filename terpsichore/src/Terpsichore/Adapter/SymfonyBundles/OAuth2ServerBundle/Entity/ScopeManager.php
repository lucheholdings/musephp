<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Doctrine\ORM\EntityManager;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\ScopeProviderStrategy;

/**
 * ScopeManager 
 * 
 * @uses ScopeProviderStrategy
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ScopeManager implements ScopeProviderStrategy 
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
		$this->class = $class;
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

	public function getSupportedScopes()
	{
		if(!$this->_scopes) {
			$this->_scopes = $this->getRepository()->findBy(array());
		}

		if(empty($this->_scopes)) {
			return array();
		}
		return $this->_scopes->map(function($scope) {
			return $scope->getScope();		
		});
	}

	public function getDefaultScopes()
	{
		$scopes = $this->getRepository()->findBy(array('isDefault' => true));
		if(empty($scopes)) {
			return array();
		}

		return $scopes->map(function($scope) {
			return $scope->getScope();
		});
	}
}

