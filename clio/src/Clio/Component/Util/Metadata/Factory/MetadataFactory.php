<?php
namespace Clio\Component\Util\Metadata\Factory;

use Clio\Component\Util\Metadata\Factory;
use Clio\Component\Util\Metadata\Mapping\Factory\Collection as MappingFactoryCollection;
use Clio\Component\Util\Metadata\Mapping\Collection as MappingCollection;
use Clio\Component\Pattern\Factory\MappedFactory;

use Clio\Component\Util\Metadata\Schema;
use Clio\Component\Util\Metadata\Schema\SchemaMetadata;
use Clio\Component\Util\Metadata\Builder\SchemaBuilder;
use Clio\Component\Util\Metadata\Field as Fields;
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
	public function createByKey($key)
	{
		$args = func_get_args();
        array_shift($args);

		return $this->createMetadata($key, $args);
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

        $schemaMetadata = $builder
            ->setType($type)
            ->enableDefaultFieldsOnType()
            ->getSchemaMetadata()
        ;

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
	public function canCreateArgs(array $args = array())
	{
		return $this->canCreateByKey(array_shift($args), $args);
	}

	/**
	 * canCreateByKey
	 * 
	 * @param mixed $key 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function canCreateByKey($key, array $args = array())
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

