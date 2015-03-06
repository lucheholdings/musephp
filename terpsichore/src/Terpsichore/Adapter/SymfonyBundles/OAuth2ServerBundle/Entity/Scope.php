<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Entity;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\Scope as BaseScope;

/**
 * Scope 
 * 
 * @uses BaseScope
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Scope extends BaseScope 
{
	/**
	 * scope 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $scope;

	/**
	 * isDefault 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $isDefault = false;

	public function __construct($scope, $isDefault = false)
	{
		$this->scope = $scope;
		$this->isDefault = $isDefault;
	}

    /**
     * getIsDefault 
     * 
     * @access public
     * @return void
     */
    public function isDefault()
    {
        return $this->isDefault;
    }
    
    /**
     * setIsDefault 
     * 
     * @param mixed $isDefault 
     * @access public
     * @return void
     */
    public function enableDefault()
    {
        $this->isDefault = true;
        return $this;
    }
    
	public function disableDefault()
	{
		$this->isDefault = false;
		return $this;
	}

    /**
     * getScope 
     * 
     * @access public
     * @return void
     */
    public function getScope()
    {
        return $this->scope;
    }
    
    /**
     * setScope 
     * 
     * @param mixed $scope 
     * @access public
     * @return void
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }
}
