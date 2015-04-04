<?php
namespace Clio\Component\Util\Type;

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
     * @access private
     */
    private $reflector;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct($name)
	{
		$this->reflector = new \ReflectionClass($name);

        if($this->reflector->isInterface()) {
            throw new \InvalidArgumentException(sprintf('"%s" is an interface.', $name));
        }

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
		case PrimitiveTypes::TYPE_OBJECT:
			return true;
		default:
            try {
			    return ($this->isInstanceOf($type) || $this->isExtends($type) || $this->getReflector()->implementsInterface($type));
            } catch(\ReflectionException $ex) {
                return false;
            }
		}
	}

    /**
     * isInstanceOf 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function isInstanceof($type)
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
        try {
		    return $this->getReflector()->implementsInterface($type);
        } catch(\RuntimeException $ex) {
        } catch(\InvalidArgumentException $ex) {
        } catch(\ReflectionException $ex) {
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
        try {
	    	return $this->getReflector()->isSubclassOf($type);
        } catch(\RuntimeException $ex) {
        } catch(\InvalidArgumentException $ex) {
        } catch(\ReflectionException $ex) {
        }
	}

    public function isValidData($data)
    {
        try {
            return $this->getReflector()->isInstance($data);
        } catch(\RuntimeException $ex) {
        } catch(\InvalidArgumentException $ex) {
        } catch(\ReflectionException $ex) {
        }
        return false;
    }
    
    public function getReflector()
    {
        return $this->reflector;
    }
    
    public function setReflector(\Reflector $reflector)
    {
        $this->reflector = $reflector;
        return $this;
    }
}

