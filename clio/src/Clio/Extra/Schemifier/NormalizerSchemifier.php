<?php
namespace Clio\Extra\Schemifier;

use Clio\Component\Normalizer\Normalizer;
use Clio\Component\Schemifier\Schemifier,
	Clio\Component\Schemifier\AbstractSchemifier;
use Clio\Component\Schemifier\Exception as SchemifierException;
use Clio\Component\Schemifier\FieldMapperRegistry;

use Clio\Component\ArrayTool\Mapper;

use Clio\Component\Normalizer\Exception as NormalizerException;
/**
 * NormalizerSchemifier 
 *   Use Normalizer to convert, normalize/denormalize, data.
 * 
 * @uses AbstractSchemifier
 * @uses Schemifier
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerSchemifier extends AbstractSchemifier implements Schemifier
{
	/**
	 * normalizer 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $normalizer;

	/**
	 * __construct 
	 * 
	 * @param ReflectionClass $schema
	 * @param Normalizer $normalizer 
	 * @access public
	 * @return void
	 */
	public function __construct($schema, Normalizer $normalizer = null, Map $fieldKeyMappers = null)
	{
		parent::__construct($schema, $fieldKeyMappers);

		$this->normalizer = $normalizer;
	}

	/**
	 * doSchemify 
	 * 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	protected function doSchemify($data, array $options = array())
	{
		$sourceType = $this->getType($data);
		$schema = $this->getSchema();
	
		if(is_object($data)){
			// 1. Normalize data
			// 2. Denormalize data to Schema
			$normalized = null;
			try {
				$normalized = $this->getNormalizer()->normalize($data);
			} catch(NormalizerException $ex) {
				throw new SchemifierException('Failed to schemify data', $sourceType, (string)$schema, 0, $ex);
			}

			$data = $normalized;
		} else if(!is_array($data)) {
			throw new \InvalidArgumentException('schemify only support schemad data which is an array or an object.');
		}

		$fieldKeyMapper = null;
		if(isset($options['field_key_mapper'])) {
			$fieldKeyMapper = $options['field_key_mapper'];
		} else if($this->hasDefaultFieldMapper($sourceType)) {
			$fiedlKeyMapper = $this->getFieldKeyMapper($sourceType);
		}
		
		// Apply FieldKeyMapper if needed.
		if($fieldKeyMapper) {
			$data = $fieldKeyMapper->map($data);
		}

		// Denormalize data to schemaData
		try {
			$model = $this->getNormalizer()->denormalize($data, (string)$schema);
		} catch(NormalizerException $ex) {
			throw new SchemifierException('Failed to schemify data', $sourceType, (string)$schema, 0, $ex);
		}
		return $model;
	}
    
    /**
     * Get normalizer.
     *
     * @access public
     * @return normalizer
     */
    public function getNormalizer()
    {
        return $this->normalizer;
    }
    
    /**
     * Set normalizer.
     *
     * @access public
     * @param normalizer the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setNormalizer($normalizer)
    {
        $this->normalizer = $normalizer;
        return $this;
    }

	/**
	 * isSupportedSchema 
	 * 
	 * @param Schema $schema 
	 * @access public
	 * @return void
	 */
	public function isSupportedSchema(Schema $schema)
	{
		return $schema->isSchemaType(Schema::SCHEMA_TYPE_CLASS);
	}
}

