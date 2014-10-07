<?php
namespace Clio\Component\Pattern\Builder;

/**
 * ComponentBuilder 
 * 
 * @uses Builder
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComponentBuilder implements Builder
{
	/**
	 * class 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $class;

	/**
	 * constructArgs 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $constructArgs;

	/**
	 * __construct 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $class, array $args = array())
	{
		$this->class = $class;
		$this->constructArgs = $args;
	}

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function build()
	{
		$object = $this->constructInstance($this->getClass());

		return $this->doBuild($object);
	}

	/**
	 * doBuild 
	 * 
	 * @param mixed $object 
	 * @access protected
	 * @return void
	 */
	protected function doBuild($object)
	{
		return $object;
	}

	/**
	 * constructInstance 
	 * 
	 * @param \ReflectionClass $class 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function constructInstance(\ReflectionClass $class, array $args = array())
	{
		return $class->newInstanceArgs($args);
	}
    
    /**
     * getClass 
     * 
     * @access public
     * @return void
     */
    public function getClass()
    {
        return $this->class;
    }
    
    /**
     * setClass 
     * 
     * @param mixed $class 
     * @access public
     * @return void
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
    
    /**
     * getConstructArgs 
     * 
     * @access public
     * @return void
     */
    public function getConstructArgs()
    {
        return $this->constructArgs;
    }
    
    /**
     * setConstructArgs 
     * 
     * @param mixed $constructArgs 
     * @access public
     * @return void
     */
    public function setConstructArgs($constructArgs)
    {
        $this->constructArgs = $constructArgs;
        return $this;
    }
}

