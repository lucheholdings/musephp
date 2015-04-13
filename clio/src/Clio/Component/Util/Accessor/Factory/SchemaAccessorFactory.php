<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Pattern\Factory\AbstractMappedFactory;
use Clio\Component\Util\Accessor\Factory;
use Clio\Component\Util\Accessor\Schema\FieldContainerSchemaAccessor;
use Clio\Component\Util\Metadata;

class SchemaAccessorFactory extends AbstractMappedFactory implements Factory 
{
    public function doCreateByKey($key, array $args)
    {
        return $this->createAccessor($key);
    }

    public function createAccessor(Metadata\Schema $schema)
    {
        return new FieldContainerSchemaAccessor($schema);
    }
}

