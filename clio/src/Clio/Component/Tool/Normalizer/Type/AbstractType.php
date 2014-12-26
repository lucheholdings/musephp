<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Context;

/**
 * AbstractType 
 * 
 * @uses Type
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractType implements Type 
{
	/**
	 * options 
	 * 
	 * @var array
	 * @access private
	 */
	private $options = array();

	/**
	 * __construct 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->options = $options;
	}
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     * 
     * @param mixed $options 
     * @access public
     * @return void
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

	/**
	 * hasOption 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasOption($name)
	{
		return isset($this->options[$name]);
	}

	/**
	 * getOption 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getOption($name)
	{
		return $this->options[$name];
	}

	/**
	 * setOption 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setOption($name, $value)
	{
		$this->options[$name] = $value;
	}

	/**
	 * __toString 
	 * 
	 * @access public
	 * @return void
	 */
	public function __toString()
	{
		return (string)$this->getName();
	}

	/**
	 * getFieldType 
	 * 
	 * @param mixed $field 
	 * @param Context $context 
	 * @access public
	 * @return void
	 */
	public function getFieldType($field, Context $context)
	{
		if($context->hasPathType($context->getPathInCurrentScope($field))) {
			return $context->getPathType($context->getPathInCurrentScope($field));
		} else {
			return new MixedType();
		}
	}
}

