<?php
namespace Clio\Extra\Tests;

use Clio\Component\Util\Accessor;
use Clio\Component\Pattern\Registry;

class TestAccessorRegistry extends Accessor\Registry\ValidateRegistry 
{
    public function __construct()
    {
        parent::__construct(new Registry\LoadableRegistry(
                new Accessor\Loader\FactoryLoader(new TestSchemaRegistry())
            ));
    }
}

