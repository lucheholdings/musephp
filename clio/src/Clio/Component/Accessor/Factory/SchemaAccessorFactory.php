<?php
namespace Clio\Component\Accessor\Factory;

use Clio\Component\Pattern\Factory;
use Clio\Component\Accessor\Factory as AccessorFactory;
use Clio\Component\Accessor\Schema;
use Clio\Component\Accessor\Builder\SchemaAccessorBuilder;
use Clio\Component\Accessor\Field\Factory as FieldAccessorFactory;
use Clio\Component\Metadata;
use Clio\Component\Type\PrimitiveTypes;

class SchemaAccessorFactory extends Factory\AbstractMappedFactory implements AccessorFactory 
{
    /**
     * fieldAccessorFactory 
     * 
     * @var mixed
     * @access private
     */
    private $fieldAccessorFactory;

    /**
     * {@inheritdoc}
     */
    public function doCreate(array $args)
    {
        return $this->doCreateAccessor(Factory\Util::shiftArg($args), Factory\Util::shiftArg($args, null, array()));
    }

    /**
     * {@inheritdoc}
     */
    public function createAccessor(Metadata\Schema $schema)
    {
        return $this->doCreateAccessor($schema, array());
    }

    protected function doCreateAccessor(Metadata\Schema $schema, array $options)
    {
        $builder = $this->createBuilder();
        $builder->setSchema($schema);

        // set fields if needed
        if(0 < count($schema->getFields())) {
            $builder->setFields($schema->getFields());
        }

        return $builder->getSchemaAccessor();
    }

    /**
     * createEmtpyAccessor 
     *    
     * @param Metadata\Schema $schema 
     * @access public
     * @return void
     */
    public function createEmtpyAccessor(Metadata\Schema $schema)
    {
        if(1 < count($schema->getFields())) {
            return new Schema\FieldContainerSchemaAccessor($schema);
        } else if($schema->isType(PrimitiveTypes::BASE_TYPE_SCALAR) || $schema->isType(PrimitiveTypes::TYPE_ARRAY)) {
            return new Schema\ScalarSchemaAccessor($schema);
        } else {
            throw new \RuntimeException(sprintf('Schema "%s" is not supported', (string)$schema));
        }
    }

    /**
     * createBuilder 
     * 
     * @access public
     * @return void
     */
    public function createBuilder()
    {
        return new SchemaAccessorBuilder($this, $this->getFieldAccessorFactory());
    }
    
    public function getFieldAccessorFactory()
    {
        if(!$this->fieldAccessorFactory) {
            // Create defualt fieldAccessorFactory
            $this->fieldAccessorFactory = new FieldAccessorFactory\PropertyAccessorFactory();
        }
        return $this->fieldAccessorFactory;
    }
    
    public function setFieldAccessorFactory(FieldAccessorFactory $fieldAccessorFactory)
    {
        $this->fieldAccessorFactory = $fieldAccessorFactory;
        return $this;
    }
}

