<?php
namespace Clio\Framework\Normalizer;

use Clio\Component\Tool\Normalizer\NormalizationStrategy,
	Clio\Component\Tool\Normalizer\DenormalizationStrategy
;

use Clio\Component\Pce\Metadata\ClassMetadata;
use Clio\Framework\Metadata\ClassMetadataRegistry;

/**
 * FieldAccessorNormalizerStrategy 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorNormalizerStrategy implements 
	NormalizationStrategy,
	DenormalizationStrategy
{
	/**
	 * classMetadataRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadataRegistry;

	/**
	 * __construct 
	 * 
	 * @param ClassMetadataRegistry $registry 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMetadataRegistry $registry)
	{
		$this->classMetadataRegistry = $registry;
	}

	/**
	 * canNormalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function canNormalize($object)
	{
		$classMetadata = $this->getClassMetadata(get_class($object));
		$accessor = $this->getClassFieldAccessor($classMetadata);

		return (bool)$accessor;
	}

	/**
	 * normalize 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function normalize($object)
	{
		var_dump(is_object($object) ? get_class($object) : gettype($object));

		$classMetadata = $this->getClassMetadata(get_class($object));
		$accessor = $this->getClassFieldAccessor($classMetadata);

		if(!$accessor) {
			throw new \Exception(sprintf('Normalizer cannot normalize an instanceof "%s".', get_class($object)));
		}

		$values = array();
		foreach($accessor->getFields($object) as $key => $value) {
			if(!is_object($value)) {
				$values[$key] = $value;
			} else {
				$values[$key] = $this->normalize($value);
			}
		}
		
		return $values;
	}

	/**
	 * canDenormalize 
	 * 
	 * @param mixed $object 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function canDenormalize($object, $class)
	{
		$classMetadata = $this->getClassMetadata($class);
		$accessor = $this->getClassFieldAccessor($classMetadata);

		return (bool)$accessor;
	}

	/**
	 * denormalize 
	 * 
	 * @param mixed $data 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function denormalize($data, $class)
	{
		$classMetadata = $this->getClassMetadata($class);
		$accessor = $this->getClassFieldAccessor($classMetadata);

		if(!$accessor) {
			throw new \Exception(sprintf('Normalizer cannot denormalize an instanceof "%s".', $class));
		}

		// Create Object
		$mapping = $classMetadata->getMapping('normalizer');
		$object = $mapping->createInstanceFromNormalizedData($data);

		foreach($data as $key => $value) {
			$accessor->set($object, $key, $value);
		}
		
		return $object;
	}


	/**
	 * getClassFieldAccessor 
	 * 
	 * @param ClassMetadata $classMetadata 
	 * @access protected
	 * @return void
	 */
	protected function getClassFieldAccessor(ClassMetadata $classMetadata = null)
	{
		if($classMetadata && $classMetadata->hasMapping('field_accessor')) {
			return $classMetadata->getMapping('field_accessor')->getAccessor();
		}

		return null;
	}
    
    /**
     * Get classMetadataRegistry.
     *
     * @access public
     * @return classMetadataRegistry
     */
    public function getClassMetadataRegistry()
    {
        return $this->classMetadataRegistry;
    }
    
    /**
     * Set classMetadataRegistry.
     *
     * @access public
     * @param classMetadataRegistry the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMetadataRegistry($classMetadataRegistry)
    {
        $this->classMetadataRegistry = $classMetadataRegistry;
        return $this;
    }

	/**
	 * getClassMetadata 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function getClassMetadata($class)
	{
		if($this->getClassMetadataRegistry()->has($class)) {
			return $this->getClassMetadataRegistry()->get($class);
		}

		return null;
	}
}

