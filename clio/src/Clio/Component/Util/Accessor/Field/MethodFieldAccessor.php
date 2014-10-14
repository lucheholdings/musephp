<?php
namespace Clio\Component\Util\Accessor\Property;

use Clio\Component\Util\Accessor\Mapping\ClassMapping;
use Clio\Component\Util\Psr\Psr0;

/**
 * MethodFieldAccessor
 * 
 * @uses FieldPropertyAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MethodPropertyFieldAccessor extends AbstractObjectFieldAccessor 
{
	/**
	 * getterReflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $getterReflector;

	/**
	 * setterReflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $setterReflector;

	/**
	 * initFieldReflector 
	 * 
	 * @param \ReflectionClass $classReflector 
	 * @param mixed $fieldName 
	 * @access protected
	 * @return void
	 */
	protected function initFieldReflector(\ReflectionClass $classReflector, $fieldName)
	{
		// Initialize Getter
		{
			if(array_key_exists('getter', $options)) {
				$getter = $options['getter'];
			} else {
				$getter = Psr0::formatMethodName('get' . ucfirst($fieldName);
			}
			if($getter) {
				if(!$classReflector->hasMethod($getter)) {
					throw new \RuntimeException('Method "%s::%s" is not exixts', $classReflector->getReflectionClass()->getName(), $getter);
				} else {
					$this->setGetterReflector($classReflector->getMethod($getter));
				}
			}
		}
		
		// Initialize Setter
		{
			if(array_key_exists('setter', $options)) {
				$setter = $options['setter'];
			} else {
				$setter = Psr0::formatMethodName('set' . ucfirst($fieldName));
			}
			
			if($setter) {
				if(!$classReflector->hasMethod($setter)) {
					throw new \RuntimeException('Method "%s::%s" is not exixts', $classReflector->getName(), $setter);
				} else {
					$this->setSetterReflector($classReflector->getMethod($setter));
				}
			}
		}
	}

	/**
	 * setValue 
	 * 
	 * @param mixed $object 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($object, $value)
	{
		$method = $this->getSetterReflector();

		return $method->invoke($object, $value);
	}

	/**
	 * getValue 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getValue($object)
	{
		$method = $this->getGetterRefelctor();

		return $method->invoke($object);
	}

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($object, $field, $type)
	{
		$isSupport = false;

		if($field == $this->getField()) {
			switch($type) {
			case self::TYPE_GET:
			case self::TYPE_IS_EMPTY:
				$isSupport = (bool)$this->getGetterReflector();
				break;
			case self::TYPE_SET:
			case self::TYPE_CLEAR:
				$isSupport = (bool)$this->getSetterReflector();
				break;
			default:
				break;
			}
		}

		return $isSupport;
	}
    
    /**
     * getGetterReflector 
     * 
     * @access public
     * @return void
     */
    public function getGetterReflector()
    {
        return $this->getterReflector;
    }
    
    /**
     * setGetterReflector 
     * 
     * @param mixed $getterReflector 
     * @access public
     * @return void
     */
    public function setGetterReflector($getterReflector)
    {
        $this->getterReflector = $getterReflector;
        return $this;
    }
    
    /**
     * getSetterReflector 
     * 
     * @access public
     * @return void
     */
    public function getSetterReflector()
    {
        return $this->setterReflector;
    }
    
    /**
     * setSetterReflector 
     * 
     * @param mixed $setterReflector 
     * @access public
     * @return void
     */
    public function setSetterReflector($setterReflector)
    {
        $this->setterReflector = $setterReflector;
        return $this;
    }
}

