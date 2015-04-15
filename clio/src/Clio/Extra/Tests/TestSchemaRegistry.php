<?php
namespace Clio\Extra\Tests;

use Clio\Component\Util\Metadata;
use Clio\Component\Util\Type;
use Clio\Component\Pattern\Loader;
use Clio\Component\Pattern\Registry;

class TestSchemaRegistry extends Metadata\SchemaRegistry\ValidateRegistry  
{
    public function __construct()
    {
        parent::__construct(new Registry\LoadableRegistry(
                Metadata\Loader\Factory::createComplexLoader(
                    array(
                        new Loader\FactoryLoader(new Metadata\Factory\MetadataFactory(Type\Registry\Factory::createDefault()))
                    ), 
                    new Metadata\Loader\Warmer($this)
                )
            ));
    }
}

