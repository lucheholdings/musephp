<?php
namespace Clio\Component\Util\Metadata\Factory;

use Clio\Component\Util\Metadata\Factory;
use Clio\Component\Util\Metadata\Mapping\Factory\Collection as MappingFactoryCollection;
use Clio\Component\Util\Metadata\Mapping\Collection as MappingCollection;
use Clio\Component\Pattern\Factory\MappedFactory;

use Clio\Component\Util\Metadata\Schema;
use Clio\Component\Util\Metadata\Schema\SchemaMetadata;
use Clio\Component\Util\Metadata\Builder\SchemaBuilder;
use Clio\Component\Util\Type as Types;
/**
 * MetadataFactory 
 *   Factory to create SchemaMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataFactory implements Factory, MappedFactory 
{
    /**
     * typeRegistry 
     * 
     * @var mixed
     * @access private
     */
    private $typeRegistry;

	/**
	 * mappingFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mappingFactory;

    /**
     * fieldFactory 
     * 
     * @var mixed
     * @access private
     */
    private $fieldFactory;

	/**
	 * __construct 
	 * 
	 * @param mixed $mappingFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(Types\Registry $typeRegistry, MappingFactory $mappingFactory = null)
	{
        $this->typeRegistry = $typeRegistry;
		$this->mappingFactory = $mappingFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKey()
	{
		$args = func_get_args();

		return $this->createMetadata(array_shift($args));
	}

	/**
	 * {@inheritdoc}
	 */
	public function createByKeyArgs($key, array $args = array())
	{
		return $this->createMetadata($key);
	}

	/**
	 * createMetadata 
	 * 
	 * @param mixed $schema 
	 * @access public
	 * @return void
	 */
	public function createMetadata($type)
	{
        $builder = $this->createBuilder();

        $builder
            ->setType($type)
            ->enableCreateFieldsFromProperty()
        ;
        // create type with type factory
        if(!$type instanceof Types\Type) {
            $type = $this->typeRegistry->createType($type);
        }

        $metadata = new SchemaMetadata($type);
        
        // Default field set if type is a class 
        if($type instanceof Types\Actual\ClassType) {
            $fields = array();
            // Create Property fields for class 
            foreach($type->getReflector()->getProperties() as $property) {
                $fields[$property->getName()] = new PropertyFieldMetadata($schema, $property);
            }

            $metadata->setFields($fields);
        } 

		if($this->getMappingFactory()) {
			$schemaMetadata->setMappings($this->getMappingFactory()->createMapping($schemaMetadata));
		}

		return $schemaMetadata;
	}
    
    public function getMappingFactory()
    {
        return $this->mappingFactory;
    }
    
    public function setMappingFactory($mappingFactory)
    {
        $this->mappingFactory = $mappingFactory;
        return $this;
    }
    
	/**
	 * {@inheritdoc}
	 */
	public function isSupportedArgs(array $args = array())
	{
		return $this->isSupportedKeyArgs(array_shift($args), $args);
	}

	/**
	 * isSupportedKeyArgs 
	 * 
	 * @param mixed $key 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function isSupportedKeyArgs($key, array $args = array())
	{
		return $this->isSupportedSchema($key);
	}

	/**
	 * isSupportedSchema 
	 * 
	 * @param mixed $schema 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	public function isSupportedSchema($schema)
    {
        return $this->getTypeRegistry()->hasType($schema);
    }
    
    /**
     * getTypeRegistry 
     * 
     * @access public
     * @return void
     */
    public function getTypeRegistry()
    {
        return $this->typeRegistry;
    }
    
    /**
     * setTypeRegistry 
     * 
     * @param mixed $typeRegistry 
     * @access public
     * @return void
     */
    public function setTypeRegistry(Types\Registry $typeRegistry)
    {
        $this->typeRegistry = $typeRegistry;
        return $this;
    }

    public function createBuilder()
    {
        return new SchemaBuilder($this, $this->getTypeRegistry());
    }

    /**
     * createFieldMetadata 
     * 
     * @param Schema $schema 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function createFieldMetadata(Schema $schema, $type)
    {
        return $this->getFieldFactory()->createFieldMetadata($schema, $type);
    }
    
    /**
     * getFieldFactory 
     * 
     * @access public
     * @return void
     */
    public function getFieldFactory()
    {
        return $this->fieldFactory;
    }
    
    /**
     * setFieldFactory 
     * 
     * @param FieldMetadataFactory $fieldFactory 
     * @access public
     * @return void
     */
    public function setFieldFactory(FieldMetadataFactory $fieldFactory)
    {
        $this->fieldFactory = $fieldFactory;
        return $this;
    }
}

