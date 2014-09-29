<?php
namespace Calliope\Framework\Core\Builder;

use Clio\Component\Pattern\Factory\ComponentFactory;
use Clio\Component\Pattern\Factory\BuilderFactory;

/**
 * SchemeModelBuilderFactory 
 * 
 * @uses BuilderFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeModelBuilderFactory extends ComponentFactory implements BuilderFactory
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($class = null)
	{
		if(!$class) {
			$class = 'Calliope\Framework\Core\Builder\SchemeModelBuilder';
		} 
		if(!$class instanceof \ReflectionClass) {
			$class = new \ReflectionClass($class);
		}

		$validationClass = 'Calliope\Framework\Core\Builder\SchemeModelBuilder';
		if(($class->getName() != $validationClass) && !$class->isSubclassOf($validationClass)) {
			throw new \InvalidArgumentException(sprintf('Class "%s" is not a subclass of "%s".', $class->getName(), $validationClass));
		}

		parent::__construct($class);
	}

	public function createBuilder()
	{
		return $this->doCreate(func_get_args());
	}
}

