<?php
namespace Clio\Extra\Schemifier;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Schemifier\Schemifier,
	Clio\Component\Tool\Schemifier\AbstractSchemifier;
use Clio\Component\Tool\Schemifier\Exception as SchemifierException;
use Clio\Component\Tool\Schemifier\FieldMapperRegistry;

use Clio\Component\Tool\ArrayTool\InverseMapper;

use Clio\Component\Tool\Normalizer\Exception as NormalizerException;
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
	protected function doSchemify($data)
	{
		$sourceType = $this->guessSourceType($data);

		if(is_object($data)){
			// 1. Normalize data
			// 2. Denormalize data to Schema
			$normalized = null;
			try {
				$normalized = $this->getNormalizer()->normalize($data);
			} catch(NormalizerException $ex) {
				throw new SchemifierException('Failed to schemify data', $sourceType, $schema, 0, $ex);
			}

			$data = $normalized;
		} else if(!is_array($data)) {
			throw new \InvalidArgumentException('schemify only support schemad data which is an array or an object.');
		}

		// Apply Field Mapper 
		if($this->fieldKeyMappers->has($sourceType)) {
			$fiedlKeyMapper = $this->fieldKeyMappers->get($sourceType);

			// Apply 
			$data = $fieldKeyMapper->map($data);
		}

		// Denormalize data to schemaData
		try {
			$model = $this->getNormalizer()->denormalize($data, $schema);
		} catch(NormalizerException $ex) {
			throw new SchemifierException('Failed to schemify data', $sourceType, $schema, 0, $ex);
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

