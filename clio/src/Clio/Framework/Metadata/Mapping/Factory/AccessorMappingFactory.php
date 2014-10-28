<?php
namespace Clio\Framework\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Mapping\Factory\AbstractFactory;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\FieldMetadata;
use Clio\Component\Util\Metadata\Schema\ClassMetadata;
use Clio\Component\Util\Accessor\SchemaAccessorFactory;
use Clio\Component\Util\Accessor\Factory\SchemaAccessorFactoryCollection;
use Clio\Component\Util\Accessor\Field\Factory\FieldAccessorFactoryCollection;

use Clio\Framework\Metadata\Mapping\SchemaAccessorMapping,
	Clio\Framework\Metadata\Mapping\FieldAccessorMapping
;

use Clio\Component\Exception\UnsupportedException;

use Clio\Component\Util\Injection\ClassInjector;

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

	public function __construct(SchemaAccessorFactoryCollection $accessorFactory, FieldAccessorFactoryCollection $fieldAccessorFactory)
	{
		$this->accessorFactory = $accessorFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createMapping(Metadata $metadata)
	{
		if($metadata instanceof ClassMetadata) {
			$mapping = new SchemaAccessorMapping($metadata);
		} else if(($metadata instanceof FieldMetadata && ($metadata->getSchemaMetadata() instanceof ClassMetadata))) {
			$mapping = $this->createFieldMapping($metadata);
		} else {
			throw new UnsupportedException('SchemaMetadata is not an instance of ClassMetadata');
		}

		return $mapping;
	}

	protected function createFeildMapping($metadata)
	{
		if($metadata instanceof PropertyMetadata) {
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
		return ($metadata instanceof ClassMetadata) || (($metadata instanceof FieldMetadata) && ($metadata->getSchemaMetadata() instanceof ClassMetadata));
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
	 * {@inheritdoc}
	 */
	public function getInjector()
	{
		if(!$this->injector) {
			// 
			$this->injector = new ClassInjector('Clio\Framework\Metadata\Mapping\FieldAccessorMapping', 'setAccessorFactory', array($this->getAccessorFactory()));
		}
		return $this->injector;
	}
}

