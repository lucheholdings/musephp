<?php
namespace Clio\Extra\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy\ObjectStrategy;
use Clio\Component\Tool\Normalizer\Strategy\NormalizationStrategy,
	Clio\Component\Tool\Normalizer\Strategy\DenormalizationStrategy
;
use Clio\Component\Util\Metadata\Exception as MetadataException;
use Clio\Component\Util\Accessor\Accessor;
use Clio\Component\Util\Accessor\Factory\DataAccessorFactory;
use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;
use Clio\Component\Tool\Normalizer\Context,
	Clio\Component\Util\Type\Type,
	Clio\Component\Util\Type as Types,
	Clio\Component\Util\Type\Converter as TypeConverter
;

use Clio\Component\Util\Accessor\Schema\Registry as SchemaAccessorRegistry;

/**
 * AccessorStrategy 
 * 
 * @uses ObjectStrategy
 * @uses NormalizationStrategy
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class AccessorStrategy extends ObjectStrategy implements NormalizationStrategy, 
	DenormalizationStrategy
{
	/**
	 * {@inheritdoc}
	 */
	private $accessorFactory;

	/**
	 * typeConverter 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $typeConverter;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadataRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaAccessorRegistry $accessorRegistry, TypeConverter $converter = null)
	{
		$this->accessorFactory = new DataAccessorFactory($accessorRegistry);
		$this->typeConverter = $converter;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doNormalize($data, Type $type, Context $context)
	{
		$accessor = $this->createDataAccessor($type, $data); 

		$fieldValues = $accessor->getFieldValues();


		//// fixme
		//$typeConverter = $this->getTypeConverter();
		//$schemaMapping = $accessor->getSchemaAccessor()->getSchema();

		//foreach($fieldValues as $field => &$value) {
		//	try {
		//		$fieldMapping = $schemaMapping->getField($field);
		//		$srcType = $fieldMapping->getMetadata()->getType();
		//	} catch (MetadataException\UnknownFieldException $ex) {
		//		// field is not defined on schema, thus we do not convert the value
		//		$srcType = new Types\MixedType(); 
		//	}


		//	// 
		//	try {
		//		$dstType = $type->getFieldType($field);
		//	} catch(MetadataException\UnknownFieldException $ex) {
		//		// desitination field is ambiguous, thus we do now convert the value
		//		continue;
		//	}

		//	if($typeConverter) {
		//		$value = $typeConverter->convert($srcType, $dstType, getType(), $value);
		//	} else {
		//		$value = $srcType->convertData($value, $dstType);
		//	}
		//}

		return $fieldValues;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		if(!$object) {
			// create new Object
			if($type instanceof Types\ProxyType) {
				$type = $type->getRawType();
			}
			$object = $type->construct();
		}

		$accessor = $this->createDataAccessor($type, $object); 

		// Set Field Values
		if(is_array($data)) {
			foreach($data as $key => $value) {
				//if($accessor->existsField($key)) {
				if($accessor->isSupportMethod($key, Accessor::ACCESS_SET)) {
					$accessor->set($key, $value);
				}
			}
		} else {
			return $data;
		}

		return $accessor->getData();
	}

	/**
	 * createAccessorWithSchema 
	 * 
	 * @param Type $type 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	protected function createDataAccessor(Type $type, $data)
	{
		return $this->getAccessorFactory()->createAccessorWithSchema($data, $type->getName());
	}
    
    /**
     * getAccessorFactory 
     * 
     * @access public
     * @return void
     */
    public function getAccessorFactory()
    {
        return $this->accessorFactory;
    }
    
    /**
     * setAccessorFactory 
     * 
     * @param mixed $accessorFactory 
     * @access public
     * @return void
     */
    public function setAccessorFactory($accessorFactory)
    {
        $this->accessorFactory = $accessorFactory;
        return $this;
    }

	/**
	 * getTypeConverter 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTypeConverter()
	{
		return $this->typeConverter;
	}

	/**
	 * setTypeConverter 
	 * 
	 * @param TypeConverter $typeConverter 
	 * @access public
	 * @return void
	 */
	public function setTypeConverter(TypeConverter $typeConverter)
	{
		$this->typeConverter = $typeConverter;
		return $this;
	}

}
