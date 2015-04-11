<?php
namespace Clio\Component\Pattern\Factory;

/**
 * ClassFactory 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClassFactory extends AbstractMappedFactory 
{
    /**
     * doCreateByKey 
     * 
     * @param array $args 
     * @access protected
     * @return void
     */
	protected function doCreateByKey($key, array $args = array())
	{
		return $this->doCreateClass($key, $args);
	}

    protected function doCreateClass($class, array $args)
    {
		if(!$class instanceof \ReflectionClass) {
			if(!is_string($class)) {
				throw new \InvalidArgumentException(sprintf('Invalid argument type "%s"', gettype($class)));
			}

			$class = new \ReflectionClass($class);
		}

		$constructorArgs = $this->resolveConstructorArgs($args);

		$newInstance = $this->getConstructor()->construct($class, $constructorArgs);

		if($this->hasValidator()) {
			$this->getValidator()->validate($newInstance);
		}
		return $newInstance;
    }

	/**
	 * createClass 
	 * 
	 * @param string|ReflectionClass $class 
	 * @access public
	 * @return void
	 */
	public function createClass($class)
	{
		$args = func_get_args();
        array_shift($args);

		return $this->doCreateClass($class, $args);
	}

	/**
	 * createClassArgs 
	 * 
	 * @param mixed $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createClassArgs($class, array $args = array())
	{
        return $this->doCreateClass($class, $args);
	}

    /**
     * resolveConstructorArgs 
     * 
     * @param array $args 
     * @access protected
     * @return void
     */
	protected function resolveConstructorArgs(array $args)
	{
		return $args;
	}

    /**
     * canCreateClass 
     * 
     * @param mixed $class 
     * @param array $args 
     * @access public
     * @return void
     */
	public function canCreateClass($class)
	{
		return class_exists($class);
	}

    /**
     * canCreateByKey 
     * 
     * @param mixed $key 
     * @param array $args 
     * @access public
     * @return void
     */
    public function canCreateByKey($key, array $args = array())
    {
        return $this->canCreateClass($key);
    }
}

