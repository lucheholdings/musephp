<?php
namespace Clio\Component\Tool\Normalizer;

/**
 * Context 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Context 
{
	/**
	 * stack 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $stack;

	/**
	 * mapper 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mapper;

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	/**
	 * typeRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $typeRegistry;

	/**
	 * __construct 
	 * 
	 * @param TypeFactory $typeFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(TypeFactory $typeFactory = null)
	{
		$this->stack = new \SplStack();
		$this->typeRegistry = new TypeRegistry($typeFactory);
	}
    
    /**
     * getStack 
     * 
     * @access public
     * @return void
     */
    public function getStack()
    {
        return $this->stack;
    }
    
    /**
     * setStack 
     * 
     * @param mixed $stack 
     * @access public
     * @return void
     */
    public function setStack($stack)
    {
        $this->stack = $stack;
        return $this;
    }

	/**
	 * getOption 
	 * 
	 * @param mixed $key 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function getOption($key, $default = null) 
	{
		return isset($this->options[$key]) 
			? $this->options[$key]
			: $default
		;
	}

	/**
	 * setOption 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setOption($key, $value)
	{
		$this->options[$key] = $value;
		return $this;
	}

	/**
	 * hasOption 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasOption($key)
	{
		return isset($this->options[$key]);
	}
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     * 
     * @param array $options 
     * @access public
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

	/**
	 * getCurrentScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function getCurrentScope()
	{
		return $this->stack->top();
	}

	/**
	 * enterScope 
	 * 
	 * @param mixed $data 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function enterScope($data, Type $type)
	{
		foreach($this->stack as $scope) {
			if($data === $scope->getData()) {
				throw new CircularException('The target object is already in scope.', $data);
			}
		}
		
		$this->stack->push(new Scope($data, $type));
	}

	/**
	 * leaveScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function leaveScope()
	{
		return $this->stack->pop();
	}

	/**
	 * getTypeRegistry 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTypeRegistry()
	{
		return $this->typeRegistry;
	}
}

