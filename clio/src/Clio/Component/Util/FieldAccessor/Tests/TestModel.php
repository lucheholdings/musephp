<?php
namespace Clio\Component\Util\FieldAccessor\Tests;

/**
 * TestModel 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TestModel 
{
	public $publicField;

	private $privateField;
    
    /**
     * Get privateField.
     *
     * @access public
     * @return privateField
     */
    public function getPrivateField()
    {
        return $this->privateField;
    }
    
    /**
     * Set privateField.
     *
     * @access public
     * @param privateField the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPrivateField($privateField)
    {
        $this->privateField = $privateField;
        return $this;
    }
}

