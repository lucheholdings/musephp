<?php
namespace Clio\Extra\Container\Validation;

use Clio\Component\Container;
use Clio\Component\Validator;

/**
 * Set 
 * 
 * @uses Container
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Set extends Container\Proxy\Set implements Container\Set 
{
    /**
     * valueValidator 
     * 
     * @var mixed
     * @access protected
     */
    protected $valueValidator;

    /**
     * __construct 
     * 
     * @param Container $container 
     * @access public
     * @return void
     */
    public function __construct(Container $container = null)
    {
        if(!$container) 
            $container = new Container\ArrayImpl\Set();

        parent::__construct($container);
    }

    /**
     * {@inheritdoc}
     */
    public function add($value)
    {
        if($this->getValueValidator()) {
            $this->getValueValidator()->validate($value);
        }
        $this->getWrapped()->add($value);
        return $this;
    }
    
    /**
     * getValueValidator 
     * 
     * @access public
     * @return void
     */
    public function getValueValidator()
    {
        return $this->valueValidator;
    }
    
    /**
     * setValueValidator 
     * 
     * @param mixed $valueValidator 
     * @access public
     * @return void
     */
    public function setValueValidator(Validator\Validator $valueValidator)
    {
        $this->valueValidator = $valueValidator;
        return $this;
    }

    /**
     * resetValueValidator 
     * 
     * @access public
     * @return void
     */
    public function resetValueValidator()
    {
        $this->valueValidator = null;
        return $this;
    }
}

