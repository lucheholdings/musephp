<?php
namespace Clio\Extra\Tests;

use Clio\Component\Pattern\Registry;
use Clio\Component\Util\Type as Types;
use Clio\Extra\Type as ExtraTypes;

class TestTypeRegistry extends Types\Registry\ValidateRegistry 
{
    public function __construct()
    {
        parent::__construct(new Registry\LoadableRegistry(Types\Loader\Factory::createWithFactories(array(
                new ExtraTypes\Factory\SchemaMetadataTypeFactory(new TestSchemaRegistry()),
                new Types\Factory\PrimitiveTypeFactory()
            ))));
    }
}

