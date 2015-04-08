<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Pattern\Registry\RegistryMap,
	Clio\Component\Pattern\Registry\LoadableRegistry,
	Clio\Component\Pattern\Registry\EntryLoader
;
use Clio\Component\Util\Validator\SubclassValidator;

/**
 * BaseRegistry 
 *    BaseRegistry is an empty registry which only configure 
 *    the rule of Type Registry. 
 * @uses LoadableRegistry
 * @uses Registry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BaseRegistry extends LoadableRegistry implements Registry
{
    /**
     * __construct 
     * 
     * @param EntryLoader $loader 
     * @access public
     * @return void
     */
	public function __construct(EntryLoader $loader)
	{
		$map = new RegistryMap();
		$map
			->setValueValidator(new SubclassValidator('Clio\Component\Util\Type\Type'))
		;

		parent::__construct($loader, $map);
	}

    /**
     * getTypes 
     * 
     * @access public
     * @return void
     */
    public function getTypes()
    {
        return $this->getValues();
    }
    
    /**
     * setTypes 
     * 
     * @param array $types 
     * @access public
     * @return void
     */
    public function setTypes(array $types)
    {
		return $this->replace($types);
    }

	/**
	 * hasType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function hasType($type)
	{
		return $this->has((string)$type);
	}

	/**
	 * guessType 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function guessType($value)
	{
		if(null === $value) {
			$type = PrimitiveTypes::TYPE_NULL;
		} elseif(is_scalar($value)) {
			$type = gettype($value);
		} elseif(is_array($value)) {
			$type = PrimitiveTypes::TYPE_ARRAY;
		} elseif(is_object($value)) {
			$type = get_class($value);
		} else {
			throw new \InvalidArgumentException('Unknown data to guess type.');
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
		//if($type instanceof FieldtType) {
		//	// switch field type
		//	if(!$this->getRegistry()->has($type->getTypeName())) {
		//		$this->load($type->getTypeName());
		//	}
		//	$type->setType($this->get($type->getTypeName()));
		//	return $type;
		//}

		if($type instanceof Type) {
			return $type;
		}

		return $this->get((string)$type);
	}

	/**
	 * addType 
	 * 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function addType(Type $type)
	{
		return $this->set($type->getName(), $type);
	}

	/**
	 * removeType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function removeType($type)
	{
		return $this->remove((string)$type);
	}
}

