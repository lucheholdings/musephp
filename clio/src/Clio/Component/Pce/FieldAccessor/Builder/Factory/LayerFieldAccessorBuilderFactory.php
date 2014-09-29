<?php
namespace Clio\Component\Pce\FieldAccessor\Builder\Factory;

use Clio\Component\Pce\FieldAccessor\Builder\LayerFieldAccessorBuilder;
use Clio\Component\Pce\FieldAccessor\Factory\FieldAccessorFactory;
use Clio\Component\Pce\Construction\ComponentFactory;

/**
 * LayerFieldAccessorBuilderFactory 
 * 
 * @uses Component
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LayerFieldAccessorBuilderFactory extends ComponentFactory 
{
	private $defaultFactories = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct('Clio\Component\Pce\FieldAccessor\Builder\LayerFieldAccessorBuilder');

	}

	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args = array())
	{
		$builder = parent::doCreate($args);

		// apply default factories
		foreach($this->defaultFactories as $priority => $factories) {
			foreach($factories as $factory) {
				$builder->addLayerFactory($factory, $priority);
			}
		}

		return $builder;
	}

	/**
	 * addDefaultLayerFactory 
	 * 
	 * @param FieldAccessorFactory $factory 
	 * @param int $priority 
	 * @access public
	 * @return void
	 */
	public function addDefaultLayerFactory(FieldAccessorFactory $factory, $priority = 0)
	{
		if(!isset($this->defaultFactories[$priority])) {
			$defaultFactories[$priority] = array();
		}

		$this->defaultFactories[$priority][] = $factory;
		return $this;
	}
}

