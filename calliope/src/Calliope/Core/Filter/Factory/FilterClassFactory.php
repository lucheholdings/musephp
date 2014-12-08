<?php
namespace Calliope\Core\Filter\Factory;

use Calliope\Core\Filter\Factory as FilterFactory;
use Clio\Component\Pattern\Factory\ClassFactory;

/**
 * FilterClassFactory 
 * 
 * @uses FilterFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FilterClassFactory extends ClassFactory implements FilterFactory 
{
	private $defaultArguments;

	public function __construct(array $defaultArguments = array())
	{
		$this->defaultArguments = $defaultArguments;
	}

	/**
	 * createFilter 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createFilter(array $arguments = array())
	{
		if(empty($args)) {
			$args = $this->getDefaultArguments();
		}

		return $this->createArgs($args);
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
    
    public function getDefaultArguments()
    {
        return $this->defaultArguments;
    }
    
    public function setDefaultArguments($defaultArguments)
    {
        $this->defaultArguments = $defaultArguments;
        return $this;
    }
}

