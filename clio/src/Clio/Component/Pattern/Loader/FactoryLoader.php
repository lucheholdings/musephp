<?php
namespace Clio\Component\Pattern\Loader;

use Clio\Component\Pattern\Factory\MappedFactory;
use Clio\Component\Pattern\Factory\Exception as FactoryException;
use Clio\Component\Pattern\Loader\Exception as LoaderException;
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
        try {
            return $this->factory->createByKey($resource);
        } catch(FactoryException $ex) {
            throw new LoaderException\InvalidResourceException('Cannot load resource', 0, $ex);
        }
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

