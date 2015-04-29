<?php
namespace Erato\Core\Model;

use Clio\Component\Tag\Tag as TagInterface;

/**
 * Tag 
 * 
 * @uses AbstractTag
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Tag implements TagInterface
{
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $name;

	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $owner;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	public function __construct($name, $owner = null)
	{
		$this->name = $name;
		$this->owner = $owner;
	}
    
    /**
     * Get name.
     *
     * @access public
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set name.
     *
     * @access public
     * @param name the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get owner.
     *
     * @access public
     * @return owner
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * Set owner.
     *
     * @access public
     * @param owner the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
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
		return (string)$this->getName();
	}
}

