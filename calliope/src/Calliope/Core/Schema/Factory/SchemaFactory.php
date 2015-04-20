<?php
namespace Calliope\Core\Schema\Factory;

use Calliope\Core\Schema\Factory;
use Calliope\Core\Schema\BuilderFactory;

/**
 * SchemaFactory 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaFactory implements Factory 
{
    /**
     * builderFactory 
     * 
     * @var mixed
     * @access private
     */
    private $builderFactory;

    /**
     * createSchema 
     * 
     * @param mixed $name 
     * @param mixed $schemaname 
     * @access public
     * @return void
     */
    public function createSchema($name, $schemaName)
    {
        $builder = $this->createBuilder();

        $builder->setName($name);
        if($schemaName) {
            $builder->setStaticSchema($schemaName);
        }

        return $builder->getSchema();
    }

    /**
     * createBuilder 
     * 
     * @access public
     * @return void
     */
    public function createBuilder()
    {
        return $this->getBuilderFactory()->create();
    }
    
    /**
     * getBuilderFactory 
     * 
     * @access public
     * @return void
     */
    public function getBuilderFactory()
    {
        return $this->builderFactory;
    }
    
    /**
     * setBuilderFactory 
     * 
     * @param mixed $builderFactory 
     * @access public
     * @return void
     */
    public function setBuilderFactory(BuilderFactory $builderFactory)
    {
        $this->builderFactory = $builderFactory;
        return $this;
    }
}

