<?php
namespace Clio\Component\Pce\Construction;

/**
 * ComponentFactory 
 * 
 * @uses Factory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComponentFactory implements Factory 
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
	 * create 
	 * 
	 * @access public
	 * @return void
	 */
	public function create()
	{
		return $this->doCreate(func_get_args());
	}

	/**
	 * createArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createArgs(array $args = array())
	{
		return $this->doCreate($args);
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
		$args = $this->resolveArguments($args);
		return $this->getReflectionClass()->newInstanceArgs($args);
	}

	protected function resolveArguments(array $args)
	{
		return $args;
	}
}

