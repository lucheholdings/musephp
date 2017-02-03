<?php
namespace Clio\Component\Util\FieldAccessor\Mapping;

/**
 * BasicClassMapping 
 * 
 * @uses ClassMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BasicClassMapping implements ClassMapping 
{
	/**
	 * reflectionClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflectionClass;

	/**
	 * fields 
	 * 
	 * @var array
	 * @access private
	 */
	private $fields = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $class, array $fields = array())
	{
		$this->reflectionClass = $class;
		$this->fields = array();

		foreach($fields as $field) {
			$this->addField($field);
		}
	}
    
    /**
     * Get reflectionClass.
     *
     * @access public
     * @return reflectionClass
     */
    public function getReflectionClass()
    {
        return $this->reflectionClass;
    }
    
    /**
     * Get fields.
     *
     * @access public
     * @return fields
     */
    public function getFields()
    {
        return $this->fields;
    }
    
    /**
     * Set fields.
     *
     * @access public
     * @param fields the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setFields(array $fields)
    {
		$this->fields = array();
		foreach($fields as $field) {
			$this->addField($field);
		}
        return $this;
    }

	/**
	 * addField 
	 * 
	 * @param FieldMapping $field 
	 * @access public
	 * @return void
	 */
	public function addField(FieldMapping $field) 
	{
		$this->fields[$field->getName()] = $field;
		return $this;
	}
}

