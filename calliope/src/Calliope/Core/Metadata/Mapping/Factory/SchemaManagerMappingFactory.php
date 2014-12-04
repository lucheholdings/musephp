<?php
namespace Calliope\Core\Metadata\Mapping\Factory;

use Clio\Extra\Metadata\Mapping\Factory\AbstractRegistryServiceMappingFactory;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Injection\ClassInjector;
use Calliope\Core\Metadata\Mapping\SchemaManagerMapping;
use Calliope\Core\Manager\Factory\ClassFactory;
use Clio\Component\Pattern\Registry\Registry;

/**
 * SchemaManagerMappingFactory 
 * 
 * @uses AbstractMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaManagerMappingFactory extends AbstractRegistryServiceMappingFactory
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
	 * {@inheritdoc}
	 */
	public function __construct(Registry $registry, ClassFactory $managerClassFactory, $defaultManagerClass = 'Calliope\Core\Manager\BasicManager')
	{
		parent::__construct($registry);

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
		
		return new SchemaManagerMapping($metadata, $this->getRegistry(), $managerClass, $options['connection'], null, $options);
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
			$this->injector = new ClassInjector('Calliope\Core\Metadata\Mapping\SchemaManagerMapping', 'setManagerClassFactory', array($this->getManagerClassFactory()));
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

