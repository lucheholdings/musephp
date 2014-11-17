<?php
namespace Erato\Core\Schemifier;

class SchemaMappingSchema implements Schema 
{
	/**
	 * mappingReflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mappingReflector;

	/**
	 * __construct 
	 * 
	 * @param SchemaMapping $mapping 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaMapping $mapping)
	{
		$this->mappingReflector = $mapping;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return $this->getMappingReflector()->getMetadata()->getName();
	}

	/**
	 * {@inheritdoc}
	 */
	public function isValidData($data)
	{
		$this->getMappingReflector()->getMetadata()->isValidaData($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSchemaType($type)
	{
		return $type === $this->getSchemaType();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSchemaType()
	{
		$metadata = $this->getMappingReflector()->getMetadata()
		if($metadata instanceof ClassMetadata) {
			return self::SCHEMA_TYPE_CLASS;
		}
	}
    
    /**
     * getMappingReflector 
     * 
     * @access public
     * @return void
     */
    public function getMappingReflector()
    {
        return $this->mappingReflector;
    }
    
    /**
     * setMappingReflector 
     * 
     * @param mixed $mappingReflector 
     * @access public
     * @return void
     */
    public function setMappingReflector($mappingReflector)
    {
        $this->mappingReflector = $mappingReflector;
        return $this;
    }
}

