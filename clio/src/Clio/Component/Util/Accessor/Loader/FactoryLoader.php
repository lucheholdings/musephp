<?php
namespace Clio\Component\Util\Accessor\Loader;

use Clio\Component\Pattern\Loader\FactoryLoader as BaseLoader;
use Clio\Component\Util\Metadata\SchemaRegistry;;
use Clio\Component\Util\Accessor\Factory;

/**
 * FactoryLoader 
 * 
 * @uses BaseLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FactoryLoader extends BaseLoader 
{
    /**
     * __construct 
     * 
     * @param SchemaRegistry $registry 
     * @access public
     * @return void
     */
    public function __construct(SchemaRegistry $registry, Factory $factory = null)
    {
        $this->schemaRegistry = $schemaRegistry;

        if(!$factory) {
            $factory = new Factory\AccessorFactory();
        }
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource)
    {
        // GEt Schema from SchemaRegistry
        $schema = $this->schemaRegistry->get($resource);

        return $this->factory->createAccessor($schema);
    }
}

