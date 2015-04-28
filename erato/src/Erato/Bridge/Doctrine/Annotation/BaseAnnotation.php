<?php
namespace Erato\Bridge\Doctrine\Annotation;

use Clio\Component\Util\Literal\CaseUtil;


/**
 * BaseAnnotation 
 * 
 * @uses Annotation
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class BaseAnnotation implements Annotation
{
    /**
     * reflector 
     *   Annotation target reflector 
     * @var mixed
     * @access private
     */
    private $reflector;

    /**
     * __construct 
     *   Set values to properties.
     *   if setter method is exists, use setter method,
     *   otherwise set to property.
     * @param array $values 
     * @access public
     * @return void
     */
	public function __construct(array $values = array())
	{
		foreach($values as $key => $value) {
            $method = CaseUtil::camelize('set_' . $key);
            if(method_exists($this, $method)) {
                $this->$method($value);
            } else {
			    $this->{$key} = $value;
            }
		}
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
    
    /**
     * setReflector 
     * 
     * @param \Reflector $reflector 
     * @access public
     * @return void
     */
    public function setReflector(\Reflector $reflector)
    {
        $this->reflector = $reflector;
        return $this;
    }
}

