<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Serializer;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Field 
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
class Field extends BaseAnnotation implements FieldMappingAnnotation 
{
	/**
	 * name 
	 * 
	 * @var string
	 * @access public
	 */
	protected $name;

	/**
	 * getType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getType()
	{
		return $this->value;
	}
    
    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		$configs = array();
		
		if($this->getName()) 
			$configs['name'] = $this->getName();

		if($this->getType())
			$configs['type'] = $this->getType();

		return $configs;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTargetMappings()
	{
		return array(
			'serializer'
		);
	}
}
