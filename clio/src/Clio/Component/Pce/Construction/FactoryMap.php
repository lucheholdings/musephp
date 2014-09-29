<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\Pce\Construction;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Validator\ClassValidator;
/**
 * FactoryMap
 * 
 * @package ${ PACKAGE }
 * @subpackage 
 * @author ${ AUTHOR }
 */
class FactoryMap extends Map 
{
	public function __construct(array $factories = array())
	{
		parent::__construct();

		$this->setValueValidator(new ClassValidator('Clio\Component\Pce\Construction\Factory'));

		foreach($factories as $key => $factory) {
			if($factory instanceof Factory) {
				$this->set($key, $factory);
			} else {
				$this->set($key, new ComponentFactory($factory));
			}
		}
	}

	public function create()
	{
		$args = func_get_args();
		$alias = array_shift($args);
		
		return $this->get($alias)->createArgs($args);
	}

	public function createArgs($alias, array $args = array())
	{
		return $this->get($alias)->createArgs($args);
	}
}

