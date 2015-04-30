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
     * {@inheritdoc}
     */
	protected function doCreate(array $args = array())
	{
		return $this->doCreateClass(Util::shiftArg($args), $args);
	}

    /**
     * doCreateClass 
     *   Create class instance 
     * @param mixed $class 
     * @param array $args 
     * @access protected
     * @return void
     */
    protected function doCreateClass($class, array $args)
    {
        try {
		    if(!$class instanceof \ReflectionClass) {
		    	if(!is_string($class)) {
		    		throw new \InvalidArgumentException(sprintf('Class has to be a string or an instanceof ReflectionClass, but "%s" is given', gettype($class)));
		    	}

		    	$class = new \ReflectionClass($class);
		    }

		    $constructorArgs = $this->resolveConstructorArgs($args);

		    $newInstance = $this->getConstructor()->construct($class, $constructorArgs);
		    return $newInstance;
        } catch(\Exception $ex) {
            throw new Exception\FailedException('', 0, $ex);
        }
    }

	/**
	 * createClassArgs 
	 * 
	 * @param mixed $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createClass($class, array $args = array())
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
}

