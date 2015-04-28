<?php
namespace Clio\Component\Util\Proxy;

/**
 * Proxy 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class Proxy 
{
    /**
     * __wrapped 
     * 
     * @var mixed
     * @access private
     */
    private $__wrapped; 

    /**
     * __construct 
     * 
     * @param mixed $wrapped 
     * @access public
     * @return void
     */
    public function __construct($wrapped = null)
    {
        $this->__wrapped = $wrapped;
    }

    /**
     * __call 
     * 
     * @param mixed $method 
     * @param array $args 
     * @access public
     * @return void
     */
    public function __call($method, array $args = array())
    {
        try {
            $classReflector = new \ReflectionClass($this->__getWrapped());
            try {
                $methodReflector = $classReflector->getMethod($method);
                if(!$methodReflector->isPublic()) {
                    throw new \RuntimeException(sprintf('Method "%s::%s" is not accessable.', get_class($this), $method));
                }
                return $methodReflector->invokeArgs($this->__getWrapped(), $args);
            } catch(\ReflectionException $ex) {
                throw new \RuntimeException(sprintf('Method "%s::%s" is not exists.', $classReflector->getName(), $method), 0, $ex);
            }
        } catch(\ReflectionException $ex) {
            throw new \RuntimeException('Wrapped object of Proxy is not initialized.', 0, $ex);
        }
    }

    /**
     * __set 
     * 
     * @param mixed $property 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function __set($property, $value)
    {
        $this->__getWrapped()->$property = $value;
    }

    /**
     * __get 
     * 
     * @param mixed $property 
     * @access public
     * @return void
     */
    public function __get($property)
    {
        return $this->__getWrapped()->$property;
    }
    
    /**
     * __getWrapped 
     * 
     * @access public
     * @return void
     */
    public function __getWrapped()
    {
        if(!$this->__wrapped) {
            $this->__initialize();
        }
        return $this->__wrapped;
    }

    /**
     * __initialize 
     * 
     * @access protected
     * @return void
     */
    protected function __initialize()
    {
        throw new \RuntimeException('Proxy::__initialize() is not implemented.');
    }
    
    /**
     * __setWrapped 
     * 
     * @param mixed $wrapped 
     * @access public
     * @return void
     */
    public function __setWrapped($wrapped)
    {
        $this->__wrapped = $wrapped;
        return $this;
    }
}

