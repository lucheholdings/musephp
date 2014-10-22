<?php
namespace Clio\Component\Util\Metadata\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory\FactoryCollection;
use Clio\Component\Util\Metadata\Mapping\MappingCollection,
	Clio\Component\Util\Metadata\Mapping\LazyMappingCollection
;

/**
 * SchemaMetadataFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class SchemaMetadataFactory 
{
	/**
	 * schemaMappingFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaMappingFactory;

	/**
	 * fieldMappingFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldMappingFactory;

	/**
	 * __construct 
	 * 
	 * @param mixed $schemaMappingFactory 
	 * @param mixed $fieldMappingFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(FactoryCollection $schemaMappingFactory = null, FactoryCollection $fieldMappingFactory = null)
	{
		$this->schemaMappingFactory = $schemaMappingFactory;
		$this->fieldMappingFactory = $fieldMappingFactory;
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

		if($this->getSchemaMappingFactory()) {
			$schemaMetadata->setMappings(new LazyMappingCollection($this->getSchemaMappingFactory()));
		}

		return $schemaMetadata;
	}
	
	/**
	 * createFieldMetadata 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function createFieldMetadata($field)
	{
		$fieldMetadata = $this->doCreateFieldMetadata($field);

		if($this->getFieldMappingFactory()) {
			$fieldMetadata->setMappings(new LazyMappingCollection($this->fieldMappingFactory));
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
	abstract protected function doCreateFieldMetadata($field);
    
    public function getSchemaMappingFactory()
    {
        return $this->schemaMappingFactory;
    }
    
    public function setSchemaMappingFactory($schemaMappingFactory)
    {
        $this->schemaMappingFactory = $schemaMappingFactory;
        return $this;
    }
    
    public function getFieldMappingFactory()
    {
        return $this->fieldMappingFactory;
    }
    
    public function setFieldMappingFactory($fieldMappingFactory)
    {
        $this->fieldMappingFactory = $fieldMappingFactory;
        return $this;
    }
}

