<?php
namespace Clio\Extra\Tests;

use Clio\Component\Metadata;
use Clio\Component\Type;
use Clio\Component\Pattern\Loader;
use Clio\Component\Pattern\Registry;

class TestSchemaRegistry extends Metadata\Registry\ValidateRegistry  
{
    public function __construct()
    {
        $registeredResolver = new Metadata\Resolver\RegisteredResolver($this);
        $typeResolver = new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault());

        parent::__construct(new Registry\LoadableRegistry(
                Metadata\Loader\Factory::createComplexLoader(
                    array(
                        new Loader\FactoryLoader(new Metadata\Factory\SchemaFactory(new Metadata\Resolver\LazyResolver($registeredResolver), $typeResolver))
                    )
                    //), 
                    //new Metadata\Loader\Warmer($this)
                )
            ));
    }
}

