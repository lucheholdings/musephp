<?php
namespace Clio\Component\Util\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Mapping\Factory;
use Clio\Component\Util\Metadata\Mapping\NamedFactory;
use Clio\Component\Util\Metadata\Mapping\Collection as MappingCollection;
use Clio\Component\Pattern\Factory\FactoryMap;
use Clio\Component\Util\Validator\SubclassValidator;

use Clio\Component\Util\Injection\InjectorMap;

/**
 * Collection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Collection extends FactoryMap implements NamedFactory 
{
	/**
	 * injector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $injector;

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

    /**
     * createMappingFor 
     * 
     * @param mixed $name 
     * @param Metadata $metadata 
     * @param array $options 
     * @access public
     * @return void
     */
    public function createMappingFor($name, Metadata $metadata, array $options = array())
    {
        return $this->getFactory($name)->createMapping($metadata, $options);
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
		$collection = new MappingCollection();
		foreach($this as $key => $factory) {
			$mappingOptions = isset($options[$key]) ? $options[$key] : array();
			if($factory->isSupportedMetadata($metadata)) {
				$mapping = $factory->createMapping($metadata, $mappingOptions);
				$collection->setMapping($mapping->getName(), $mapping);
			}
		}

		return $collection;
	}

	/**
	 * {@inheritdoc}
	 */
	protected function initFactory()
	{
		$this->getStorage()->setValueValidator(new SubclassValidator('Clio\Component\Util\Metadata\Mapping\Factory'));
	}

	/**
	 * isSupportedMetadata 
	 * 
	 * @access public
	 * @return void
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return true;
	}

	/**
	 * getInjector 
	 * 
	 * @access public
	 * @return InjectorMap
	 */
	public function getInjector()
	{
		if(!$this->injector) {
			$this->injector = new InjectorMap();

			foreach($this as $name => $factory) {
				$injector = $factory->getInjector();
				if($injector) {
					$this->injector->set($name, $injector);
				}
			}
		}

		return $this->injector;
	}
    
    public function getOptions()
    {
        return $this->options;
    }
    
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }
}

