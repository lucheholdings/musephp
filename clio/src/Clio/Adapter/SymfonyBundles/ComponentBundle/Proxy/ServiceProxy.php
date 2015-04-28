<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Proxy;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ServiceProxy 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ServiceProxy 
{
    /**
     * __wrapped 
     * 
     * @var mixed
     * @access private
     */
    private $__wrapped;

    /**
     * __container 
     * 
     * @var mixed
     * @access private
     */
    private $__container;

    /**
     * __serviceId 
     * 
     * @var mixed
     * @access private
     */
    private $__serviceId;

    /**
     * __construct 
     * 
     * @param ContainerInterface $container 
     * @param mixed $serviceId 
     * @access public
     * @return void
     */
    public function __construct(ContainerInterface $container, $serviceId)
    {
        $this->__container = $container;
        $this->__serviceId = $serviceId;
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
        return call_user_func_array(array($this->__getWrapped(), $method), $args);
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
            $this->__wrapped = $this->__container->get($this->__serviceId);
        }

        return $this->__wrapped;
    }

    /**
     * __getServiceId 
     * 
     * @access public
     * @return void
     */
    public function __getServiceId()
    {
        return $this->__serviceId;
    }

    /**
     * __getContainer 
     * 
     * @access public
     * @return void
     */
    public function __getContainer()
    {
        return $this->__container;
    }
}

