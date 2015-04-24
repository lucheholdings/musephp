<?php
namespace Clio\Component\Util\Accessor\Loader;

use Clio\Component\Pattern\Loader\FactoryLoader as BaseLoader;
use Clio\Component\Util\Metadata\Resolver as SchemaResolver;
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
    private $schemaResolver;
    
    private $factory;
    /**
     * __construct 
     * 
     * @param SchemaResolver $registry 
     * @access public
     * @return void
     */
    public function __construct(SchemaResolver $schemaResolver, Factory $factory = null)
    {
        $this->schemaResolver = $schemaResolver;

        if(!$factory) {
            $factory = new Factory\SchemaAccessorFactory();
        }
        parent::__construct($factory);
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource)
    {
        // GEt Schema from SchemaResolver
        $schema = $this->schemaResolver->resolve($resource);

        return parent::load($schema);
    }
}

