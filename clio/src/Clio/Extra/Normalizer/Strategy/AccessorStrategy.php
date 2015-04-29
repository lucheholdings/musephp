<?php
namespace Clio\Extra\Normalizer\Strategy;

use Clio\Component\Normalizer\Strategy as Strategies;
use Clio\Component\Normalizer\Type;
use Clio\Component\Normalizer\Context;

use Clio\Component\Type as Types;
use Clio\Extra\Type as ExtraTypes;
use Clio\Component\Accessor\Registry as AccessorRegistry;
use Clio\Component\Accessor;
use Clio\Component\Accessor\Field\SingleFieldAccessor,
    Clio\Component\Accessor\Field\MultiFieldAccessor
;

//use Clio\Component\Normalizer\Strategy\NormalizationStrategy,
//	Clio\Component\Normalizer\Strategy\DenormalizationStrategy
//;
//use Clio\Component\Metadata\Exception as MetadataException;
//use Clio\Component\Accessor\Accessor;
//use Clio\Component\Accessor\Factory\DataAccessorFactory;
//use Clio\Component\Accessor\SchemaAccessorFactory;
//use Clio\Component\Accessor\Factory\BasicClassAccessorFactory;
//
//
//use Clio\Component\Normalizer\Context,
//	Clio\Component\Type as Types,
//	Clio\Component\Type\Converter as TypeConverter
//;


/**
 * AccessorStrategy 
 * 
 * @uses Strategies\ObjectStrategy
 * @uses Strategies\NormalizationStrategy
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class AccessorStrategy extends Strategies\ObjectStrategy implements Strategies\NormalizationStrategy, 
	Strategies\DenormalizationStrategy
{
    private $accessorRegistry;

    /**
     * __construct 
     * 
     * @param AccessorRegistry $accessorRegistry 
     * @access public
     * @return void
     */
	public function __construct(AccessorRegistry $accessorRegistry)
	{
        $this->accessorRegistry = $accessorRegistry;
	}

    /**
     * {@inheritdoc}
     */
    public function canNormalize($data, $type)
    {
        return $this->getAccessorRegistry()->has((string)$type);
    }

	/**
	 * {@inheritdoc}
	 */
	protected function doNormalize($data, Type $type, Context $context)
	{
        // Get accessor from Schema name 
        $accessor = $this->getAccessorRegistry()->get($type->getName());

        if($accessor instanceof Accessor\Field\MultiFieldAccessor) {
            return $accessor->getFieldValues($data);
        } else if($accessor instanceof Accessor\Field\SingleFieldAccessor) {
		    return $accessor->get($data);
        }

        throw new \RuntimeException('AccessorStrategy only support either SingleFieldAccessor or MultiFieldAccessor');
	}

    /**
     * {@inheritdoc}
     */
    public function canDenormalize($data, $type)
    {
        return $this->getAccessorRegistry()->has((string)$type);
    }

	/**
	 * {@inheritdoc}
	 */
	protected function doDenormalize($data, Type $type, Context $context, $base = null)
	{
        $accessor = $this->getAccessorRegistry()->get($type->getName());

        // Create dataAccessor with Base data
        $dataAccessor = $accessor->createDataAccessor($base);

		// Set Field Values
		if($accessor instanceof MultiFieldAccessor) {
            if(is_array($data)) {
			    foreach($data as $key => $value) {
			    	if($dataAccessor->isSupportedAccess($key, Accessor\Accessor::ACCESS_TYPE_SET)) {
			    		$dataAccessor->set($key, $value);
			    	}
			    }
            } else {
                throw new \InvalidArgumentException(sprintf('Denormalizing type "%s" only accept array data.', (string)$type));
            }
		} else if($accessor instanceof SingleFieldAccessor) {
			$dataAccessor->set($data);
		}

		return $dataAccessor->getData();
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
	public function setTypeConverter(Types\Converter\TypeConverter $typeConverter)
	{
		$this->typeConverter = $typeConverter;
		return $this;
	}
    
    /**
     * getAccessorRegistry 
     * 
     * @access public
     * @return Clio\Component\Accessor\Registry 
     */
    public function getAccessorRegistry()
    {
        return $this->accessorRegistry;
    }
    
    /**
     * setAccessorRegistry 
     * 
     * @param Clio\Component\Accessor\Registry $accessorRegistry 
     * @access public
     * @return void
     */
    public function setAccessorRegistry(AccessorRegistry $accessorRegistry)
    {
        $this->accessorRegistry = $accessorRegistry;
        return $this;
    }
}
