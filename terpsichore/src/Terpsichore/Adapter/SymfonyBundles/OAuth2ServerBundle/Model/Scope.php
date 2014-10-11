<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

/**
 * Scope 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Scope implements ScopeInterface 
{
	/**
	 * id 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $id;

	/**
	 * scope 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $scope;
    
    /**
     * getId 
     * 
     * @access public
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * setId 
     * 
     * @param mixed $id 
     * @access public
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->scope;
    }
    
    /**
     * setName 
     * 
     * @param mixed $scope 
     * @access public
     * @return void
     */
    public function setName($scope)
    {
        $this->scope = $scope;
        return $this;
    }

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return (string)$this->scope;
	}
}

