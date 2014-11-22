<?php
namespace Calliope\Core\Filter\Factory;

use Calliope\Core\Filter\Factory as FilterFactory;
use Clio\Component\Pattern\Factory\ComponentFactory;

/**
 * ClassFilterFactory 
 * 
 * @uses FilterFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassFilterFactory implements FilterFactory 
{
	/**
	 * createFilter 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createFilter(array $options = array())
	{
		if(!isset($options['class'])) {
			throw new \InvalidArgumentException('ClassFilterFactory requires "class" on options.');
		}
		$class = $options['class'];

		$args = array();
		if(isset($options['arguments'])) {
			$args = $options['arguments'];
		}

		$constructor = $this->getFilterConstructor($class);

		return $constructor->create($args);
	}

	/**
	 * getFilterConstructor 
	 * 
	 * @param mixed $class 
	 * @access protected
	 * @return void
	 */
	protected function getFilterConstructor($class)
	{
		return new ComponentFactory($class);
	}
}

