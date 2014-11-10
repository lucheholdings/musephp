<?php
namespace Clio\Adapter\Doctrine\Mapping;

/**
 * TagSet 
 * 
 * @uses MappingConfiguration
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 */
class TagSet extends Configuration
{
	/**
	 * field 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $field;

	/**
	 * class 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $class;
    
    /**
     * Get field.
     *
     * @access public
     * @return field
     */
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * Set field.
     *
     * @access public
     * @param field the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }
    
    /**
     * Get class.
     *
     * @access public
     * @return class
     */
    public function getClass()
    {
        return $this->class;
    }
    
    /**
     * Set class.
     *
     * @access public
     * @param class the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
}

