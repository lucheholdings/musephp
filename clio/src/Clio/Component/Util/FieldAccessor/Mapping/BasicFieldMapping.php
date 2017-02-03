<?php
namespace Clio\Component\Util\FieldAccessor\Mapping;

/**
 * BasicFieldMapping 
 * 
 * @uses FieldMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicFieldMapping implements FieldMapping
{
	/**
	 * classMapping 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMapping;

	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * skipField 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $skipField;

	/**
	 * ignoreField 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $ignoreField;

	/**
	 * options 
	 * 
	 * @var array
	 * @access private
	 */
	private $options = array();

	/**
	 * accessType 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessType;

	/**
	 * getterMethod 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $getterMethod;

	/**
	 * setter 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $setterMethod;

	/**
	 * __construct 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMapping $classMapping, $field)
	{
		$this->classMapping = $classMapping;
		$this->name = $field;
	}

    /**
     * Get name.
     *
     * @access public
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set name.
     *
     * @access public
     * @param name the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get skipField.
     *
     * @access public
     * @return skipField
     */
    public function isSkipField()
    {
        return $this->skipField;
    }
    
    /**
     * Set skipField.
     *
     * @access public
     * @param skipField the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSkipField($skipField)
    {
        $this->skipField = $skipField;
        return $this;
    }
    
    /**
     * Get ignoreField.
     *
     * @access public
     * @return ignoreField
     */
    public function isIgnoreField()
    {
        return $this->ignoreField;
    }
    
    /**
     * Set ignoreField.
     *
     * @access public
     * @param ignoreField the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setIgnoreField($ignoreField)
    {
        $this->ignoreField = $ignoreField;
        return $this;
    }
    
    /**
     * Get accessType.
     *
     * @access public
     * @return accessType
     */
    public function getAccessType()
    {
        return $this->accessType;
    }
    
    /**
     * Set accessType.
     *
     * @access public
     * @param accessType the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAccessType($accessType)
    {
        $this->accessType = $accessType;
        return $this;
    }
    
    /**
     * Get getterMethod.
     *
     * @access public
     * @return getterMethod
     */
    public function getGetterMethod()
    {
        return $this->getterMethod;
    }
    
    /**
     * Set getterMethod.
     *
     * @access public
     * @param getterMethod the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setGetterMethod($getterMethod)
    {
        $this->getterMethod = $getterMethod;
        return $this;
    }
    
    /**
     * Get setterMethod.
     *
     * @access public
     * @return setterMethod
     */
    public function getSetterMethod()
    {
        return $this->setterMethod;
    }
    
    /**
     * Set setterMethod.
     *
     * @access public
     * @param setterMethod the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSetterMethod($setterMethod)
    {
        $this->setterMethod = $setterMethod;
        return $this;
    }
    
    /**
     * Get classMapping.
     *
     * @access public
     * @return classMapping
     */
    public function getClassMapping()
    {
        return $this->classMapping;
    }
    
    /**
     * Set classMapping.
     *
     * @access public
     * @param classMapping the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMapping($classMapping)
    {
        $this->classMapping = $classMapping;
        return $this;
    }
}

