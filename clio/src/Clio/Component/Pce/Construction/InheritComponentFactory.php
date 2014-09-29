<?php
namespace Clio\Component\Pce\Construction;

/**
 * InheritComponentFactory 
 * 
 * @uses ComponentFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class InheritComponentFactory extends ComponentFactory 
{
	/**
	 * createInheritClass 
	 * 
	 * @param string|ReflectionClass $class Inherit class
	 * @access public
	 * @return void
	 */
	public function createInheritClass($class)
	{
		$args = func_get_args();
		array_shift($args);
		return $this->createInheritClassArgs($class, $args);
	}

	public function createInheritClassArgs($class, array $args)
	{
		if(!$class instanceof \ReflectionClass) {
			$class = new \ReflectionClass($class);
		}

		if(($class != $this->getReflectionClass()) && !$class->isSubclassOf($this->getReflectionClass())) {
			throw new \InvalidArgumentException(sprintf(
				'Class "%s" is not a subclass of "%s"',
				$class->getName(),
				$this->getReflectionClass()->getName()
			));
		}

		return $class->newInstanceArgs($args);
	}
}

