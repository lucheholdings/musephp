<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Tool\Normalizer\Type\Factory as TypeFactory;
use Clio\Component\Tool\Normalizer\Type\Factory\BasicFactory;

class TypeRegistry 
{
	/**
	 * types 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $types;

	/**
	 * typeFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $typeFactory;

	/**
	 * __construct 
	 * 
	 * @param TypeFactory $typeFactory 
	 * @access public
	 * @return void
	 */
	public function __construct(TypeFactory $typeFactory = null)
	{
		$this->types = array();
		if(!$typeFactory) {
			$typeFactory = new BasicFactory();
		}
		$this->typeFactory = $typeFactory;
	}

	/**
	 * guessType 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	public function guessType($data)
	{
		if(is_object($data)) {
			$type = get_class($data);
		} else if(is_array($data)) {
			$type = 'array';
		} else if(is_null($data)){
			$type = 'null';
		} else {
			$type = gettype($data);
		}

		return $this->getType($type);
	}

	/**
	 * getType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function getType($type)
	{
		return ($type instanceof Type) 
			? $type 
			: (isset($this->types[(string)$type]) 
				? $this->types[(string)$type] 
				: $this->createType($type)
			  )
		;
	}

	public function resolveMixed(Type\MixedType $mixed, $data)
	{
		$factory = $this->getTypeFactory();
		$type    = null;

		if(is_scalar($data)) {
			$type = $factory->createType(gettype($data), $mixed->getOptions());
		} else if(is_array($data)) {
			$type = $factory->createType('array', $mixed->getOptions());
		} else if(is_object($data)) {
			$type = $factory->createType(get_class($data), $mixed->getOptions());
		} else {
			// null 
			$type = new Type\NullType();
		}

		return $type;
	}

	/**
	 * createType 
	 * 
	 * @param mixed $type 
	 * @access protected
	 * @return void
	 */
	protected function createType($type)
	{
		$this->types[(string)$type] = $this->getTypeFactory()->createType($type);

		return $this->types[(string)$type];
	}
    
    /**
     * getTypeFactory 
     * 
     * @access public
     * @return void
     */
    public function getTypeFactory()
    {
        return $this->typeFactory;
    }
    
    /**
     * setTypeFactory 
     * 
     * @param TypeFactory $typeFactory 
     * @access public
     * @return void
     */
    public function setTypeFactory(TypeFactory $typeFactory)
    {
        $this->typeFactory = $typeFactory;
        return $this;
    }
}

