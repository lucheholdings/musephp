<?php
namespace Clio\Extra\Model;

/**
 * Model 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Model 
{
	/**
	 * id 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $id;
    
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
}
