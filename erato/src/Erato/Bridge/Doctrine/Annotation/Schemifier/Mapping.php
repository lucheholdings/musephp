<?php
namespace Erato\Bridge\Doctrine\Annotation\Schemifier;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Mapping
 * 
 * @uses BaseAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class Mapping extends BaseAnnotation implements FieldMappingAnnotation 
{
	/**
	 * from 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $from;

	/**
	 * field 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $field;
    
    /**
     * getFrom 
     * 
     * @access public
     * @return void
     */
    public function getFrom()
    {
        return $this->from;
    }
    
    /**
     * setFrom 
     * 
     * @param mixed $from 
     * @access public
     * @return void
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }
    
    /**
     * getField 
     * 
     * @access public
     * @return void
     */
    public function getField()
    {
        return $this->field;
    }
    
    /**
     * setField 
     * 
     * @param mixed $field 
     * @access public
     * @return void
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

	public function getConfigs()
	{
		return array(
			
		);
	}

	public function getTargetMappings()
	{
		return array(
			'schemifier'
		);
	}
}
