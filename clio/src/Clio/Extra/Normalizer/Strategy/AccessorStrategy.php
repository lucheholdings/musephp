<?php
namespace Clio\Extra\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Strategy as Strategies;
use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;

use Clio\Component\Util\Type as Types;
use Clio\Extra\Type as ExtraTypes;
use Clio\Component\Util\Accessor\Registry as AccessorRegistry;
use Clio\Component\Util\Accessor;
use Clio\Component\Util\Accessor\Field\SingleFieldAccessor,
    Clio\Component\Util\Accessor\Field\MultiFieldAccessor
;

//use Clio\Component\Tool\Normalizer\Strategy\NormalizationStrategy,
//	Clio\Component\Tool\Normalizer\Strategy\DenormalizationStrategy
//;
//use Clio\Component\Util\Metadata\Exception as MetadataException;
//use Clio\Component\Util\Accessor\Accessor;
//use Clio\Component\Util\Accessor\Factory\DataAccessorFactory;
//use Clio\Component\Util\Accessor\SchemaAccessorFactory;
//use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;
//
//
//use Clio\Component\Tool\Normalizer\Context,
//	Clio\Component\Util\Type as Types,
//	Clio\Component\Util\Type\Converter as TypeConverter
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
     * @return Clio\Component\Util\Accessor\Registry 
     */
    public function getAccessorRegistry()
    {
        return $this->accessorRegistry;
    }
    
    /**
     * setAccessorRegistry 
     * 
     * @param Clio\Component\Util\Accessor\Registry $accessorRegistry 
     * @access public
     * @return void
     */
    public function setAccessorRegistry(AccessorRegistry $accessorRegistry)
    {
        $this->accessorRegistry = $accessorRegistry;
        return $this;
    }
}
