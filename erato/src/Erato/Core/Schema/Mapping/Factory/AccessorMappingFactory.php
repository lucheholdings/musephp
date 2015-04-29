<?php
namespace Erato\Core\Schema\Mapping\Factory;

use Clio\Component\Metadata\Mapping\Factory\AbstractFactory;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Schema\ClassMetadata;
use Clio\Component\Metadata\FieldMetadata,
	Clio\Component\Metadata\Field\PropertyMetadata
;
use Clio\Component\Accessor\Schema\AccessorFactory as SchemaAccessorFactory;
use Clio\Component\Accessor\Field\FieldAccessorFactory;

use Erato\Core\Schema\Mapping\SchemaAccessorMapping,
	Erato\Core\Schema\Mapping\FieldAccessorMapping
;

use Clio\Component\Exception\UnsupportedException;

use Clio\Component\Injection\ClassInjector;
use Clio\Component\Injection\InjectorCollection;

use Erato\Core\CodingStandard;

/**
 * AccessorMappingFactory 
 * 
 * @uses AbstractFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AccessorMappingFactory extends AbstractFactory 
{
	private $injector;

	private $schemaAccessorFactory;

	private $fieldAccessorFactory;

	private $ignoreUnderscored;

	private $codingRule;

	public function __construct(SchemaAccessorFactory $schemaAccessorFactory, FieldAccessorFactory $fieldAccessorFactory, CodingStandard $codingRule = null, $ignoreUnderscored = true)
	{
		$this->schemaAccessorFactory = $schemaAccessorFactory;
		$this->fieldAccessorFactory = $fieldAccessorFactory;

		$this->ignoreUnderscored = $ignoreUnderscored;

		$this->codingRule = $codingRule;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateMapping(Metadata $metadata, array $options)
	{
		if($metadata instanceof ClassMetadata) {
			$mapping = new SchemaAccessorMapping($metadata, $options);
		} else if(($metadata instanceof FieldMetadata)) {
			$mapping = $this->createFieldMapping($metadata, $options);
		} else {
			throw new UnsupportedException('SchemaMetadata is not an instance of ClassMetadata');
		}

		return $mapping;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function createFieldMapping($metadata, array $options)
	{
		if($this->ignoreUnderscored && (0 === strpos($metadata->getName(), '_'))) {
			$accessType = 'ignore';
		} else if($metadata instanceof PropertyMetadata) {
			if($metadata->getReflectionProperty()->isPublic()) {
				$accessType = 'public_property';
			} else { 
				$accessType = 'method';
			}
		} else {
			$accessType = 'method';
		}

		if(!isset($options['alias'])) 
			$options['alias'] = $this->getCodingRule()->formatNaming(CodingStandard::NAMING_ACCESSOR_FIELD, $metadata->getName());

		return new FieldAccessorMapping($metadata, $accessType, $options);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return ($metadata instanceof ClassMetadata) || (($metadata instanceof FieldMetadata));
	}
    
    /**
     * getFieldAccessorFactory 
     * 
     * @access public
     * @return void
     */
    public function getFieldAccessorFactory()
    {
        return $this->fieldAccessorFactory;
    }
    
    /**
     * setFieldAccessorFactory 
     * 
     * @param mixed $fieldAccessorFactory 
     * @access public
     * @return void
     */
    public function setFieldAccessorFactory($fieldAccessorFactory)
    {
        $this->fieldAccessorFactory = $fieldAccessorFactory;
        return $this;
    }
    
    public function getSchemaAccessorFactory()
    {
        return $this->schemaAccessorFactory;
    }
    
    public function setSchemaAccessorFactory($schemaAccessorFactory)
    {
        $this->schemaAccessorFactory = $schemaAccessorFactory;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getInjector()
	{
		if(!$this->injector) {
			// 
			$this->injector = new InjectorCollection(array(
				new ClassInjector('Erato\Core\Schema\Mapping\SchemaAccessorMapping', 'setAccessorFactory', array($this->getSchemaAccessorFactory())),
				new ClassInjector('Erato\Core\Schema\Mapping\FieldAccessorMapping', 'setAccessorFactory', array($this->getFieldAccessorFactory()))
			));
		}
		return $this->injector;
	}
    
    public function getCodingRule()
    {
        return $this->codingRule;
    }
    
    public function setCodingRule($codingRule)
    {
        $this->codingRule = $codingRule;
        return $this;
    }
}

