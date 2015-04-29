<?php
namespace Clio\Component\Metadata\Loader;

use Clio\Component\Metadata\Factory;

/**
 * DefaultSchemaLoader 
 * 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DefaultSchemaLoader implements Loader 
{
    /**
     * factory 
     * 
     * @var Clio\Component\Metadata\Factory 
     * @access private
     */
    private $factory;

    /**
     * __construct 
     * 
     * @param Clio\Component\Metadata\Factory $factory 
     * @access public
     * @return void
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * load 
     * 
     * @param mixed $type 
     * @access public
     * @return Clio\Component\Metadata\Schema
     */
    public function load($type)
    {
        return $this->factory->createMetadata($type);
    }
    
    /**
     * getFactory 
     * 
     * @access public
     * @return Clio\Component\Metadata\Factory 
     */
    public function getFactory()
    {
        return $this->factory;
    }
    
    /**
     * setFactory 
     * 
     * @param Clio\Component\Metadata\Factory $factory 
     * @access public
     * @return Clio\Component\Metadata\Loader\DefaultSchemaLoader
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;
        return $this;
    }
}

