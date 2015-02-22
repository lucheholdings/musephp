<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Normalizer;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Field 
 * 
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
	 * getType 
	 * 
	 * @access public
	 * @return void
	 */
	public function getType()
	{
		return $this->getValue();
	}

	/**
	 * getConfigs 
	 * 
	 * @access public
	 * @return void
	 */
	public function getConfigs()
	{
		return array(
			'type'  => $this->getType(),
		);
	}

	/**
	 * getTargetMappings 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTargetMappings()
	{
		return array(
			'normalizer',
		);
	}
}

