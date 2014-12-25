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
	private $normalizer;

	/**
	 * scopeStack 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $scopeStack;

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
	public function __construct(TypeRegistry $typeRegistry = null)
	{
		$this->scopeStack = new \SplStack();

		if(!$typeRegistry) 
			$typeRegistry = new TypeRegistry();

		$this->typeRegistry = $typeRegistry;
	}
    
    /**
     * getStack 
     * 
     * @access public
     * @return void
     */
    public function getScopeStack()
    {
        return $this->scopeStack;
    }
    
    /**
     * setStack 
     * 
     * @param mixed $scopeStack 
     * @access public
     * @return void
     */
    public function setScopeStack($scopeStack)
    {
        $this->scopeStack = $scopeStack;
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
		return $this->scopeStack->top();
	}

	/**
	 * enterScope 
	 * 
	 * @param mixed $data 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function enterScope($data, Type $type, $field = '_source')
	{
		if($type instanceof Type\MixedType) {
			$type->resolve($this, $data);
		}
		if(is_object($data)) {
			foreach($this->scopeStack as $scope) {
				if($data === $scope->getData()) {
					throw new CircularException($data, $type, sprintf('The target object "%s" is already in scope.', $type->getName()));
				}
			}
		}
		
		$this->scopeStack->push(new Scope($data, $type, $field));
	}

	/**
	 * leaveScope 
	 * 
	 * @access public
	 * @return void
	 */
	public function leaveScope()
	{
		return $this->scopeStack->pop();
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
    
    public function getNormalizer()
    {
        return $this->normalizer;
    }
    
    public function setNormalizer(Normalizer $normalizer)
    {
        $this->normalizer = $normalizer;
        return $this;
    }

	public function getScopePath()
	{
		$path = '';
		foreach($this->scopeStack as $scope) {
			$path = $scope->getPath() . '.' . $path;
		}

		return $path;
	}

	public function isEmptyScope()
	{
		return $this->scopeStack->isEmpty();
	}
}

