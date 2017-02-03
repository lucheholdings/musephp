<?php
namespace Clio\Framework\Tests\Models;

class TestModel01 
{
	public $publicProperty;

	private $privateProperty;
    
    /**
     * Get privateProperty.
     *
     * @access public
     * @return privateProperty
     */
    public function getPrivateProperty()
    {
        return $this->privateProperty;
    }
    
    /**
     * Set privateProperty.
     *
     * @access public
     * @param privateProperty the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setPrivateProperty($privateProperty)
    {
        $this->privateProperty = $privateProperty;
        return $this;
    }
}

