<?php
namespace Clio\Component\Pce\Metadata;

/**
 * MappableClassMetadata 
 * 
 * @uses AbstractMetadata
 * @uses ClassMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MappableClassMetadata extends AbstractMetadata implements ClassMetadata
{
    /**
     * __construct 
     * 
     * @param mixed $argument 
     * @access public
     * @return void
     */
    public function __construct($argument)
    {
		if(!($argument instanceof \ReflectionClass)) {
			$argument = new \ReflectionClass($argument);
		}

		parent::__construct($argument);
    }

	/**
	 * getReflectionClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getReflectionClass()
	{
		return $this->getReflector();
	}

    /**
     * getConstant 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function getConstant($name)
    {
        return $this->getReflector()->getConstant($name);
    }

    /**
     * getConstants 
     * 
     * @access public
     * @return void
     */
    public function getConstants()
    {
        return $this->getReflector()->getConstants();
    }

    /**
     * getConstructor 
     * 
     * @access public
     * @return void
     */
    public function getConstructor()
    {
        return $this->getReflector()->getConstructor();
    }

    /**
     * getDefaultProperties 
     * 
     * @access public
     * @return void
     */
    public function getDefaultProperties()
    {
        return $this->getReflector()->getDefaultProperties();
    }

    /**
     * getDocComment 
     * 
     * @access public
     * @return void
     */
    public function getDocComment()
    {
        return $this->getReflector()->getDocComment();
    }

    /**
     * getEndLine 
     * 
     * @access public
     * @return void
     */
    public function getEndLine()
    {
        return $this->getReflector()->getEndLine();
    }

    /**
     * getExtension 
     * 
     * @access public
     * @return void
     */
    public function getExtension()
    {
        return $this->getReflector()->getExtension();
    }

    /**
     * getExtensionName 
     * 
     * @access public
     * @return void
     */
    public function getExtensionName()
    {
        return $this->getReflector()->getExtensionName();
    }

    /**
     * getFileName 
     * 
     * @access public
     * @return void
     */
    public function getFileName()
    {
        return $this->getReflector()->getFileName();
    }

    /**
     * getInterfaceNames 
     * 
     * @access public
     * @return void
     */
    public function getInterfaceNames()
    {
        return $this->getReflector()->getInterfaceNames();
    }

    /**
     * getInterfaces 
     * 
     * @access public
     * @return void
     */
    public function getInterfaces()
    {
        return $this->getReflector()->getInterfaces();
    }

    /**
     * getMethod 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function getMethod($name)
    {
        return $this->getReflector()->getMethod($name);
    }

    /**
     * getMethods 
     * 
     * @param mixed $filter 
     * @access public
     * @return void
     */
    public function getMethods($filter = null)
    {
        return $this->getReflector()->getMethods($filter = null);
    }

    /**
     * getModifiers 
     * 
     * @access public
     * @return void
     */
    public function getModifiers()
    {
        return $this->getReflector()->getModifiers();
    }

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->getReflector()->getName();
    }

    /**
     * getNamespaceName 
     * 
     * @access public
     * @return void
     */
    public function getNamespaceName()
    {
        return $this->getReflector()->getNamespaceName();
    }

    /**
     * getParentClass 
     * 
     * @access public
     * @return void
     */
    public function getParentClass()
    {
        return $this->getReflector()->getParentClass();
    }

    /**
     * getProperties 
     * 
     * @param mixed $filter 
     * @access public
     * @return void
     */
    public function getProperties($filter = null)
    {
        return $this->getReflector()->getProperties($filter = null);
    }

    /**
     * getProperty 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function getProperty($name)
    {
        return $this->getReflector()->getProperty($name);
    }

    /**
     * getShortName 
     * 
     * @access public
     * @return void
     */
    public function getShortName()
    {
        return $this->getReflector()->getShortName();
    }

    /**
     * getStartLine 
     * 
     * @access public
     * @return void
     */
    public function getStartLine()
    {
        return $this->getReflector()->getStartLine();
    }

    /**
     * getStaticProperties 
     * 
     * @access public
     * @return void
     */
    public function getStaticProperties()
    {
        return $this->getReflector()->getStaticProperties();
    }

    /**
     * getStaticPropertyValue 
     * 
     * @param mixed $name 
     * @param mixed $def_value 
     * @access public
     * @return void
     */
    public function getStaticPropertyValue($name , &$def_value = null)
    {
        return $this->getReflector()->getStaticPropertyValue($name , $def_value);
    }

    /**
     * getTraitAliases 
     * 
     * @access public
     * @return void
     */
    public function getTraitAliases()
    {
        return $this->getReflector()->getTraitAliases();
    }

    /**
     * getTraitNames 
     * 
     * @access public
     * @return void
     */
    public function getTraitNames()
    {
        return $this->getReflector()->getTraitNames();
    }

    /**
     * getTraits 
     * 
     * @access public
     * @return void
     */
    public function getTraits()
    {
        return $this->getReflector()->getTraits();
    }

    /**
     * hasConstant 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function hasConstant($name)
    {
        return $this->getReflector()->hasConstant($name);
    }

    /**
     * hasMethod 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function hasMethod($name)
    {
        return $this->getReflector()->hasMethod($name);
    }

    /**
     * hasProperty 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function hasProperty($name)
    {
        return $this->getReflector()->hasProperty($name);
    }

    /**
     * implementsInterface 
     * 
     * @param mixed $interface 
     * @access public
     * @return void
     */
    public function implementsInterface($interface)
    {
        return $this->getReflector()->implementsInterface($interface);
    }

    /**
     * inNamespace 
     * 
     * @access public
     * @return void
     */
    public function inNamespace()
    {
        return $this->getReflector()->inNamespace();
    }

    /**
     * isAbstract 
     * 
     * @access public
     * @return void
     */
    public function isAbstract()
    {
        return $this->getReflector()->isAbstract();
    }

    /**
     * isCloneable 
     * 
     * @access public
     * @return void
     */
    public function isCloneable()
    {
        return $this->getReflector()->isCloneable();
    }

    /**
     * isFinal 
     * 
     * @access public
     * @return void
     */
    public function isFinal()
    {
        return $this->getReflector()->isFinal();
    }

    /**
     * isInstance 
     * 
     * @param mixed $object 
     * @access public
     * @return void
     */
    public function isInstance($object)
    {
        return $this->getReflector()->isInstance($object);
    }

    /**
     * isInstantiable 
     * 
     * @access public
     * @return void
     */
    public function isInstantiable()
    {
        return $this->getReflector()->isInstantiable();
    }

    /**
     * isInterface 
     * 
     * @access public
     * @return void
     */
    public function isInterface()
    {
        return $this->getReflector()->isInterface();
    }

    /**
     * isInternal 
     * 
     * @access public
     * @return void
     */
    public function isInternal()
    {
        return $this->getReflector()->isInternal();
    }

    /**
     * isIterateable 
     * 
     * @access public
     * @return void
     */
    public function isIterateable()
    {
        return $this->getReflector()->isIterateable();
    }

    /**
     * isSubclassOf 
     * 
     * @param mixed $class 
     * @access public
     * @return void
     */
    public function isSubclassOf($class)
    {
        return $this->getReflector()->isSubclassOf($class);
    }

    /**
     * isTrait 
     * 
     * @access public
     * @return void
     */
    public function isTrait()
    {
        return $this->getReflector()->isTrait();
    }

    /**
     * isUserDefined 
     * 
     * @access public
     * @return void
     */
    public function isUserDefined()
    {
        return $this->getReflector()->isUserDefined();
    }

    /**
     * newInstance 
     * 
     * @access public
     * @return void
     */
    public function newInstance()
    {
        return call_user_func_array(
			array($this->getReflector(), 'newInstance'),
			func_get_args()
		);
    }

    /**
     * newInstanceArgs 
     * 
     * @param array $args 
     * @access public
     * @return void
     */
    public function newInstanceArgs(array $args = array())
    {
        return $this->getReflector()->newInstanceArgs($args);
    }

    /**
     * newInstanceWithoutConstructor 
     * 
     * @access public
     * @return void
     */
    public function newInstanceWithoutConstructor()
    {
        return $this->getReflector()->newInstanceWithoutConstructor();
    }

    /**
     * setStaticPropertyValue 
     * 
     * @param mixed $name 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function setStaticPropertyValue($name ,$value)
    {
        $this->getReflector()->setStaticPropertyValue($name ,$value);
    }

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return $this->getName();
	}
}

