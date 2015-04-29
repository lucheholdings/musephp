<?php
namespace Clio\Extra\Pattern\Factory;

use Clio\Component\Pattern\Factory;
use Clio\Component\Util\Validator\Validator;

/**
 * ValidationFactory 
 * 
 * @uses ProxyFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValidationFactory extends Factory\ProxyFactory 
{
    /**
     * validator 
     * 
     * @var mixed
     * @access private
     */
    private $validator;

    /**
     * doCreate 
     * 
     * @param array $args 
     * @access protected
     * @return void
     */
    protected function doCreate(array $args = array())
    {
        $created = parent::doCreate($args); 

        if($this->validator) {
            $this->validator->validate($created);
        }

        return $created;
    }
    
    /**
     * getValidator 
     * 
     * @access public
     * @return void
     */
    public function getValidator()
    {
        return $this->validator;
    }
    
    /**
     * setValidator 
     * 
     * @param Validator\Validator $validator 
     * @access public
     * @return void
     */
    public function setValidator(Validator\Validator $validator)
    {
        $this->validator = $validator;
        return $this;
    }
}
