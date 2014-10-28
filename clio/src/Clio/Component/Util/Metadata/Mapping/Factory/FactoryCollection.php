<?php
namespace Clio\Component\Util\Metadata\Mapping\Factory;

use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Metadata\Mapping\Factory;
use Clio\Component\Util\Metadata\Mapping\MappingCollection;
use Clio\Component\Pattern\Factory\FactoryCollection as BaseFactoryCollection;
use Clio\Component\Util\Validator\ClassValidator;

use Clio\Component\Util\Injection\InjectorCollection;

/**
 * FactoryCollection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FactoryCollection extends BaseFactoryCollection implements Factory 
{
	/**
	 * injector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $injector;

	/**
	 * createTypeMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function createMapping(Metadata $metadata)
	{
		$collection = new MappingCollection();
		foreach($this as $key => $factory) {
			if($factory->isSupportedMetadata($metadata)) {
				$mapping = $factory->createMapping($metadata);
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
		$this->setValueValidator(new ClassValidator('Clio\Component\Util\Metadata\Mapping\Factory'));
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
	 * @return void
	 */
	public function getInjector()
	{
		if(!$this->injector) {
			$this->injector = new InjectorCollection();

			foreach($this as $factory) {
				$injector = $factory->getInjector();
				if($injector) {
					$this->injector->addInjector($injector);
				}
			}
		}

		return $this->injector;
	}
}

