<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * MethodPropertyAccessor
 * 
 * @uses FieldPropertyAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MethodPropertyAccessor extends AbstractSingleFieldAccessor 
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
     * __construct 
     * 
     * @param mixed $fieldName 
     * @param \ReflectionMethod $getter 
     * @param \ReflectionMethod $setter 
     * @access public
     * @return void
     */
    public function __construct($fieldName, \ReflectionMethod $getterReflector = null, \ReflectionMethod $setterReflector = null)
    {
        parent::__construct($fieldName);

        $this->getterReflector = $getterReflector;
        $this->setterReflector = $setterReflector;
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

        if(!$this->isSupportedAccess($object, self::ACCESS_TYPE_SET)) {
            throw new \RuntimeException('Invalid Access.');
        }

        return $method->invoke($object, $value);
    }

    /**
     * get 
     * 
     * @param mixed $object 
     * @access public
     * @return void
     */
    public function get($object)
    {
        $method = $this->getGetterReflector();

        if(!$this->isSupportedAccess($object, self::ACCESS_TYPE_GET)) {
            throw new \RuntimeException('Invalid Access.');
        }

        return $method->invoke($object);
    }

    /**
     * isSupportedAccess 
     * 
     * @param mixed $object 
     * @param mixed $accessType 
     * @access public
     * @return void
     */
    public function isSupportedAccess($object, $accessType)
    {
        $isSupported = false;

        switch($accessType) {
        case self::ACCESS_TYPE_GET:
            $reflector = $this->getGetterReflector();
            $isSupported = $reflector && ($reflector->getDeclaringClass()->isInstance($object));
            break;
        case self::ACCESS_TYPE_SET:
            $reflector = $this->getSetterReflector();
            $isSupported = $reflector && ($reflector->getDeclaringClass()->isInstance($object));
            break;
        default:
            throw new \InvalidArgumentException(sprintf('AccessType "%s" is invalid.', (string)$accessType));
            break;
        }

        return $isSupported;
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
    public function setGetterReflector(\ReflectionMethod $getterReflector)
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
    public function setSetterReflector(\ReflectionMethod $setterReflector)
    {
        $this->setterReflector = $setterReflector;
        return $this;
    }
}

