<?php
namespace Calliope\Core\Schema\Builder\Factory;

use Erato\Core\Schema\Registry as StaticSchemaRegistry;

/**
 * BuilderFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BuilderFactory 
{
    /**
     * staticSchemaRegistry 
     * 
     * @var mixed
     * @access private
     */
    private $staticSchemaRegistry;

    /**
     * __construct 
     * 
     * @param StaitcSchemaRegistry $staticSchemaRegistry 
     * @access public
     * @return void
     */
    public function __construct(StaitcSchemaRegistry $staticSchemaRegistry = null)
    {
        $this->staticSchemaRegistry = $staticSchemaRegistry;
    }

    /**
     * create 
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        return new BasicBuilder($this->getStaticSchemaRegistry());
    }
    
    /**
     * getStaticSchemaRegistry 
     * 
     * @access public
     * @return void
     */
    public function getStaticSchemaRegistry()
    {
        return $this->staticSchemaRegistry;
    }
    
    /**
     * setStaticSchemaRegistry 
     * 
     * @param StaticSchemaRegistry $staticSchemaRegistry 
     * @access public
     * @return void
     */
    public function setStaticSchemaRegistry(StaticSchemaRegistry $staticSchemaRegistry)
    {
        $this->staticSchemaRegistry = $staticSchemaRegistry;
        return $this;
    }
}

