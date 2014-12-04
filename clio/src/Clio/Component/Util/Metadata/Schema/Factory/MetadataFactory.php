<?php
namespace Clio\Component\Util\Metadata\Schema\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory\Collection as MappingFactoryCollection;
use Clio\Component\Util\Metadata\Mapping\Collection as MappingCollection;
use Clio\Component\Pattern\Factory\MappedFactory;
use Clio\Component\Util\Metadata\SchemaMetadata;
/**
 * MetadataFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class MetadataFactory implements MappedFactory 
{
	/**
	 * mappingFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mappingFactory;

	/**
	 * __construct 
	 * 
	 * @param mixed $mappingFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(MappingFactoryCollection $mappingFactory = null)
	{
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
	public function createMetadata($schema)
	{
		$schemaMetadata = $this->doCreateMetadata($schema);

		if($this->getMappingFactory()) {
			$schemaMetadata->setMappings($this->getMappingFactory()->createMapping($schemaMetadata));
		}

		// CleanUp Metadata 
		// This calls to resolve mapping relation.
		$schemaMetadata->clean();

		return $schemaMetadata;
	}
	
	/**
	 * createFieldMetadata 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function createFieldMetadata(SchemaMetadata $schema, $fieldName)
	{
		$fieldMetadata = $this->doCreateFieldMetadata($schema, $fieldName);

		if($this->getMappingFactory()) {
			$fieldMetadata->setMappings($this->getMappingFactory()->createMapping($fieldMetadata));
		}

		return $fieldMetadata;
	}

	/**
	 * doCreateMetadata 
	 * 
	 * @param mixed $schema 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doCreateMetadata($schema);

	/**
	 * doCreateFieldMetadata 
	 * 
	 * @param mixed $field 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doCreateFieldMetadata(SchemaMetadata $schema, $fieldName);
    
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
	abstract public function isSupportedSchema($schema);
}

