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
	 * name 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $name;
    
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
        return $this->name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
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
		return (string)$this->name;
	}
}

