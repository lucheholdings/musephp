<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Pattern\Factory\AbstractMappedFactory;
use Clio\Component\Util\Accessor\Factory;
use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Metadata;
use Clio\Component\Util\Type\PrimitiveTypes;

class SchemaAccessorFactory extends AbstractMappedFactory implements Factory 
{
    /**
     * doCreateByKey 
     * 
     * @param mixed $key 
     * @param array $args 
     * @access public
     * @return void
     */
    public function doCreateByKey($key, array $args)
    {
        return $this->createAccessor($key);
    }

    /**
     * createAccessor 
     * 
     * @param Metadata\Schema $schema 
     * @access public
     * @return void
     */
    public function createAccessor(Metadata\Schema $schema)
    {
        if(1 < count($schema->getFields())) {
            return new Schema\FieldContainerSchemaAccessor($schema);
        } else if($schema->isType(PrimitiveTypes::BASE_TYPE_SCALAR) || $schema->isType(PrimitiveTypes::TYPE_ARRAY)) {
            return new Schema\ScalarSchemaAccessor($schema);
        } else {
            throw new \RuntimeException(sprintf('Schema "%s" is not supported', (string)$schema));
        }
    }
}

