<?php
namespace Clio\Extra\Tests;

use Clio\Component\Accessor;
use Clio\Component\Metadata;
use Clio\Component\Pattern\Registry;

class TestAccessorRegistry extends Accessor\Registry\ValidateRegistry 
{
    public function __construct()
    {
        parent::__construct(new Registry\LoadableRegistry(
                new Accessor\Loader\FactoryLoader(new Metadata\Resolver\RegisteredResolver(new TestSchemaRegistry()))
            ));
    }
}

