<?php
namespace Erato\Core\Schema\Mapping\Factory;

use Clio\Component\Metadata\Mapping\Factory\AbstractSchemaMetadataMappingFactory;
use Erato\Core\Schema\Mapping\SchemaManagerMapping;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\SchemaMetadata;
use Clio\Component\Injection\ClassInjector;
use Erato\Core\Manager\Factory\SchemaManagerClassFactory;

/**
 * SchemaManagerMappingFactory 
 * 
 * @uses AbstractMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaManagerMappingFactory extends AbstractSchemaMetadataMappingFactory
{
	/**
	 * managerClassFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $managerClassFactory;

	/**
	 * defaultManagerClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultManagerClass;

	/**
	 * injector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $injector;

	/**
	 * {@inheritdoc}
	 */
	public function __construct(SchemaManagerClassFactory $managerClassFactory, $defaultManagerClass = 'Erato\Core\Manager\BasicSchemaManager')
	{
		$this->managerClassFactory = $managerClassFactory;
		$this->defaultManagerClass = $defaultManagerClass;
	}

	/**
	 * {@inheritdoc}
	 */
	public function doCreateMapping(Metadata $metadata, array $options)
	{
		if(isset($options['manager_class'])) {
			$managerClass = $options['manager_class'];
		} else {
			$managerClass = $this->defaultManagerClass;
		}
		return new SchemaManagerMapping($metadata, $managerClass, null, $options);
	}

	/**
	 * isSupportedMetadata 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return ($metadata instanceof SchemaMetadata);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getInjector()
	{
		if(!$this->injector) {
			// 
			$this->injector = new ClassInjector('Erato\Core\Schema\Mapping\SchemaManagerMapping', 'setManagerClassFactory', array($this->getManagerClassFactory()));
		}
		return $this->injector;
	}
    
    public function getManagerClassFactory()
    {
        return $this->managerClassFactory;
    }
    
    public function setManagerClassFactory($managerClassFactory)
    {
        $this->managerClassFactory = $managerClassFactory;
        return $this;
    }
    
    public function getDefaultManagerClass()
    {
        return $this->defaultManagerClass;
    }
    
    public function setDefaultManagerClass($defaultManagerClass)
    {
        $this->defaultManagerClass = $defaultManagerClass;
        return $this;
    }
}

