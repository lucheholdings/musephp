<?php
namespace Clio\Framework\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\MappingFactory;
use Clio\Component\Pce\Metadata\Metadata,
	Clio\Component\Pce\Metadata\ClassMetadata;

use Clio\Component\Pattern\Factory\Factory,
	Clio\Component\Pattern\Factory\ComponentFactory;
use Clio\Framework\Metadata\Mapping\FieldAccessorMapping;

use Clio\Component\Util\FieldAccessor\Factory\PropertyFieldCollectionAccessorFactory;
use Clio\Component\Util\FieldAccessor\Mapping\Factory\FieldMappingFactory;

/**
 * FieldAccessorMappingFactory 
 * 
 * @uses MappingFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorMappingFactory implements MappingFactory
{
	/**
	 * fieldMappingFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldMappingFactory;
	/**
	 * defaultBuilderFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultBuilderFactory;

	/**
	 * __construct 
	 * 
	 * @param BuilderFactory $builderFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(FieldMappingFactory $fieldMappingFactory, Factory $builderFactory = null)
	{
		$this->fieldMappingFactory = $fieldMappingFactory;

		if($builderFactory) {
			$this->defaultBuilderFactory = $builderFactory;
		} else {
			$this->defaultBuilderFactory = new ComponentFactory('Clio\Component\Util\FieldAccessor\Builder\LayerFieldAccessorBuilder');
		}

		if(!$this->defaultBuilderFactory->getReflectionClass()->implementsInterface('Clio\Component\Util\FieldAccessor\Builder\FieldAccessorBuilder')) {
			throw new \RuntimeException('The class factory provide is not an instanceof BuilderFactory.');
		}
	}

	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createMapping(Metadata $metadata, array $options = array())
	{
		$mapping = null;
		if($metadata instanceof ClassMetadata) {
			// Create 
			$mapping = new FieldAccessorMapping($metadata);

			$mapping->setFields($this->getFieldMappingFactory()->createFieldMappings($mapping));
			$mapping->setAccessorBuilder($this->createAccessorBuilder($mapping, $options));
		}

		return $mapping;
	}

	/**
	 * createAccessor 
	 * 
	 * @param ClassMetadataInterafce $classMetadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createAccessorBuilder(FieldAccessorMapping $mapping, array $options = array())
	{
		//
		$builder = $this->getAccessorBuilderFactory()->create();

		return $builder;
	}

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		return 'field_accessor';
	}

	/**
	 * getAccessorBuilderFactory 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAccessorBuilderFactory()
	{
		// Fixme: use options to choose factory

		return $this->getDefaultAccessorBuilderFactory();
	}

    /**
     * Get defaultBuilderFactory.
     *
     * @access public
     * @return defaultBuilderFactory
     */
    public function getDefaultAccessorBuilderFactory()
    {
        return $this->defaultBuilderFactory;
    }
    
    /**
     * Set defaultBuilderFactory.
     *
     * @access public
     * @param defaultBuilderFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDefaultAccessorBuilderFactory($defaultBuilderFactory)
    {
        $this->defaultBuilderFactory = $defaultBuilderFactory;
        return $this;
    }
    
    /**
     * Get fieldMappingFactory.
     *
     * @access public
     * @return fieldMappingFactory
     */
    public function getFieldMappingFactory()
    {
        return $this->fieldMappingFactory;
    }
    
    /**
     * Set fieldMappingFactory.
     *
     * @access public
     * @param fieldMappingFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setFieldMappingFactory($fieldMappingFactory)
    {
        $this->fieldMappingFactory = $fieldMappingFactory;
        return $this;
    }
}

