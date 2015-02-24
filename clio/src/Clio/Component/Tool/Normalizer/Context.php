<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Util\Type as Types,
	Clio\Component\Util\Type\Type,
	Clio\Component\Util\Type\Resolver as TypeResolver;

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
	 * typeResolver 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $typeResolver;

	/**
	 * pathTypes
	 * 
	 * @var mixed
	 * @access private
	 */
	private $pathTypes;

	private $dataPool;

	/**
	 * __construct 
	 * 
	 * @param TypeFactory $typeFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(TypeResolver $typeResolver = null)
	{
		$this->scopeStack = new \SplStack();

		if(!$typeResolver) 
			$typeResolver = new TypeResolver();

		$this->typeResolver = $typeResolver;
		$this->dataPool = new Tool\DataPool();
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
	public function enterScope($data, Type $type, $field = '_')
	{
		if($type instanceof ProxyType) {
			$type->resolve($this->getTypeResolver(), $data);
		}

		if(is_object($data)) {
			foreach($this->scopeStack as $scope) {
				if($data === $scope->getData()) {
					throw new CircularException($data, $type, sprintf('The target object "%s" for path "%s" is already in scope.', $type->getName(), $this->getPathInCurrentScope($field)));
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
	 * getTypeResolver 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTypeResolver()
	{
		return $this->typeResolver;
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
		$paths = array();
		foreach($this->scopeStack as $scope) {
			array_unshift($paths, $scope->getPath());
		}

		return implode($paths, '.');
	}

	public function getPathInCurrentScope($path)
	{
		$prefix = $this->getScopePath();
		if($prefix) 
			$path = $prefix . '.' . $path;

		return $path;
	}

	public function isEmptyScope()
	{
		return $this->scopeStack->isEmpty();
	}

	public function hasPathType($path)
	{
		return isset($this->pathTypes[$path]);
	}

	public function getPathType($path)
	{
		return $this->pathTypes[$path];
	}
    
	public function setPathType($path, $type)
	{
		$path = '_.' . $path;
		$this->pathTypes[$path] = $type;
		return $this;
	}
    
    public function getPathTypes()
    {
        return $this->pathTypes;
    }
    
    public function setPathTypes($pathTypes)
    {
        foreach($pathTypes as $path => $type) {
			$this->setPathType($path, $type);	
		}
        return $this;
    }

	/**
	 * getFieldType 
	 *   Get FieldType in Current Scope 
	 * @param mixed $type 
	 * @param mixed $field 
	 * @access public
	 * @return FieldType|Type
	 */
	public function getFieldType($type, $field)
	{
		$fieldPath = $this->getPathInCurrentScope($field);

		if($this->hasPathType($fieldPath)) {
			return $this->getPathType($fieldPath);
		} else if((($type instanceof Types\FieldContainable) || $type->isType(Types\PrimitiveTypes::TYPE_OBJECT)) && $type->hasFieldType($field)) {
			$fieldType = $type->getFieldType($field);

			return $fieldType;
		}
		
		// Return mixed field type.
		return new Types\FieldType();
	}
    
    public function getDataPool()
    {
        return $this->dataPool;
    }

	public function getScopeConfiguration($key, $default = null)
	{
		return $default;
	}
}

