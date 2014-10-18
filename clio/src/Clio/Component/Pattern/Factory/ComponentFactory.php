<?php
namespace Clio\Component\Pattern\Factory;

/**
 * ComponentFactory 
 *    Factory of the specified class. 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComponentFactory extends ClassFactory implements Factory 
{
	/**
	 * reflectionClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflectionClass;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($class)
	{
		if($class instanceof \ReflectionClass) {
			$this->reflectionClass = $class;
		} else {
			$this->reflectionClass = new \ReflectionClass($class);
		}
	}
    
    /**
     * Get reflectionClass.
     *
     * @access public
     * @return reflectionClass
     */
    public function getReflectionClass()
    {
		if(!$this->reflectionClass) {
			throw new \Exception('ReflectionClass for ComponentFactory is not initialized.');
		}
        return $this->reflectionClass;
    }
    
	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args)
	{
		return $this->createComponent($args);
	}

	/**
	 * createComponent 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createComponent(array $args = array())
	{
		$args = $this->resolveArgs($args);

		return $this->getConstructor()->construct($this->getReflectionClass(), $args);
	}
}

