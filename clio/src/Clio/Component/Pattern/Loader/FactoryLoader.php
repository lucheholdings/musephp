<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Pattern\Factory\MappedFactory;
/**
 * FactoryLoader 
 *   FactoryLoader is a Loader loading with a Factory.
 *   
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FactoryLoader implements Loader 
{
    /**
     * factory 
     * 
     * @var mixed
     * @access private
     */
    private $factory;

    /**
     * __construct 
     * 
     * @param MappedFactory $factory 
     * @access public
     * @return void
     */
    public function __construct(MappedFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * load 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function load($resource)
    {
        return $this->factory->createByKey($resource);
    }

    /**
     * canLoad 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function canLoad($resource)
    {
        return $this->factory->canCreateByKey($resource);
    }
    
    /**
     * getFactory 
     * 
     * @access public
     * @return void
     */
    public function getFactory()
    {
        return $this->factory;
    }
    
    /**
     * setFactory 
     * 
     * @param mixed $factory 
     * @access public
     * @return void
     */
    public function setFactory(MappedFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }
}

