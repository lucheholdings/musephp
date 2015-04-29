<?php
namespace Clio\Component\Type\Actual;

use Clio\Component\Type\AbstractType;
use Clio\Component\Type\PrimitiveTypes;

/**
 * ClassType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassType extends AbstractType 
{
    /**
     * reflector 
     * 
     * @var mixed
     * @access protected 
     */
    protected $reflector;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name)
	{
        if(!class_exists($name)) {
            throw new \InvalidArgumentException(sprintf('Class "%s" is not exists.', $name));
        }
        $this->reflector = new \ReflectionClass($name);

		parent::__construct($name);
	}

	/**
	 * isType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isType($type)
	{
		$type = (string)$type;

		switch($type) {
		case PrimitiveTypes::TYPE_CLASS:
		case PrimitiveTypes::TYPE_ALIAS_OBJECT:
			return true;
		default:
			return ($this->isName($type) || $this->isExtends($type) || $this->isImplements($type));
		}
	}

    /**
     * isName 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function isName($type)
    {
        return ($this->getReflector()->getName() == ltrim($type, '\\'));
    }

	/**
	 * isImplements 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isImplements($type)
	{
        if(interface_exists($type)) {
            return $this->getReflector()->implementsInterface($type);
        }

        return false;
	}

	/**
	 * isExtends 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isExtends($type)
	{
        if(class_exists($type)) {
            return $this->getReflector()->isSubclassOf($type);
        }
        return false;
	}

    /**
     * isValidData 
     * 
     * @param mixed $data 
     * @access public
     * @return void
     */
    public function isValidData($data)
    {
        if(is_object($data)) {
            return $this->getReflector()->isInstance($data);
        }

        return false;
    }
    
    /**
     * getReflector 
     * 
     * @access public
     * @return void
     */
    public function getReflector()
    {
        return $this->reflector;
    }

    public function newData(array $args = array())
    {
        $constructor = $this->reflector->getConstructor();

        // try using constructor to create new object.
        if($constructor) {
            if(empty($args)) {
                if(0 < $constructor->getNumberOfRequiredParameters()) {
                    return $this->reflector->newInstanceWithoutConstructor();
                } else {
                    return $this->reflector->newInstance();
                }
            } else {
                return $this->reflector->newInstanceArgs($args);
            }
        } else {
            return $this->reflector->newInstanceWithoutConstructor();
        }
    }
}

