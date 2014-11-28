<?php
namespace Erato\Core\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory\AbstractFactory;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Util\Metadata\FieldMetadata,
	Clio\Component\Util\Metadata\Field\PropertyMetadata
;
use Clio\Component\Util\Accessor\Schema\AccessorFactory as SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

use Erato\Core\Metadata\Mapping\SchemaAccessorMapping,
	Erato\Core\Metadata\Mapping\FieldAccessorMapping
;

use Clio\Component\Exception\UnsupportedException;

use Clio\Component\Util\Injection\ClassInjector;
use Clio\Component\Util\Injection\InjectorCollection;

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

	public function __construct(SchemaAccessorFactory $schemaAccessorFactory, FieldAccessorFactory $fieldAccessorFactory, $ignoreUnderscored = true)
	{
		$this->schemaAccessorFactory = $schemaAccessorFactory;
		$this->fieldAccessorFactory = $fieldAccessorFactory;

		$this->ignoreUnderscored = $ignoreUnderscored;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doCreateMapping(Metadata $metadata)
	{
		if($metadata instanceof ClassMetadata) {
			$mapping = new SchemaAccessorMapping($metadata);
		} else if(($metadata instanceof FieldMetadata)) {
			$mapping = $this->createFieldMapping($metadata);
		} else {
			throw new UnsupportedException('SchemaMetadata is not an instance of ClassMetadata');
		}

		return $mapping;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function createFieldMapping($metadata)
	{
		if($this->ignoreUnderscored && (0 === strpos($metadata->getName(), '_'))) {
			$accessType = 'ignore';
		} else if($metadata instanceof PropertyMetadata) {
			if($metadata->getReflectionProperty()->isPublic()) {
				$accessType = 'property';
			} else { 
				$accessType = 'method';
			}
		} else {
			$accessType = 'method';
		}
		return new FieldAccessorMapping($metadata, $accessType);
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
				new ClassInjector('Erato\Core\Metadata\Mapping\SchemaAccessorMapping', 'setAccessorFactory', array($this->getSchemaAccessorFactory())),
				new ClassInjector('Erato\Core\Metadata\Mapping\FieldAccessorMapping', 'setAccessorFactory', array($this->getFieldAccessorFactory()))
			));
		}
		return $this->injector;
	}
}

