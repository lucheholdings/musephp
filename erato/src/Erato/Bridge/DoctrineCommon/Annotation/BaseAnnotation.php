<?php
namespace Erato\Bridge\DoctrineCommon\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Clio\Component\Util\Grammer\Grammer;


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
abstract class BaseAnnotation 
{
	/**
	 * value 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $value;

	public function __construct(array $values = array())
	{
		foreach($values as $key => $value) {
			$this->{$key} = $value;
		}
	}
    
    /**
     * getValue 
     * 
     * @access public
     * @return void
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * setValue 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}

