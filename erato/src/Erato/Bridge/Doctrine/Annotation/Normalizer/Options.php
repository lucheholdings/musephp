<?php
namespace Erato\Bridge\Doctrine\Annotation\Normalizer;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Options 
 * 
 *   Normalizer\Options(key=value, key={idx:value})
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 *
 * @Annotation
 * @Target({"ALL"})
 */
class Options implements FieldMappingAnnotation 
{
	/**
	 * values 
	 * 
	 * @var array
	 * @access protected
	 */
	public $values;

	public function __construct(array $values = array())
	{
		$this->values = $values;
	}

	/**
	 * getValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getValues()
	{
		return $this->values;
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
			'options' => $this->getValues(),
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

