<?php
namespace Clio\Component\Util\Type;

/**
 * TypeRegistry 
 * 
 * @uses RegistryMap
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeRegistry extends RegistryMap
{
	/**
	 * getValueValidator 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getValueValidator()
	{
		return new ClassValidator('Clio\Component\Util\Type\Type');
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
	 * addType 
	 * 
	 * @param Type $type 
	 * @access public
	 * @return void
	 */
	public function addType(Type $type)
	{
		if($type instanceof FieldType) {
			$type = $type->getType();
		}

		return $this->set($type->getName(), $type);
	}

	/**
	 * hasType 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasType($name)
	{
		return $this->has($name);
	}

	/**
	 * getType 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getType($type)
	{
		if($type instanceof Type) {
			return $type;
		}

		return $this->get($name);
	}

	public function guessType($value)
	{
		if(null === $value)) {
			$type = PrimitiveTypes::TYPE_NULL;
		} else if(is_scalar($value)) {
			$type = gettype($value);
		} else if(is_object($value)) {
			$type = get_class($value);
		} else {
			$type = PrimitiveTypes::TYPE_MIXED;
		}

		return $this->getType($type);
	}

	/**
	 * removeType 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function removeType($name)
	{
		return $this->remove($name);
	}
}

