<?php
namespace Erato\Bridge\Doctrine\Annotation\Normalizer;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Compact 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 *
 * @Annotation
 * @Target({"ALL"})
 * @Attributes({
 *   @Attribute("value", type = "bool"),
 * })
 */
class Compact extends BaseAnnotation implements FieldMappingAnnotation 
{
	/**
	 * value 
	 * 
	 * @var bool 
	 * @access protected
	 */
	protected $value = true;

	/**
	 * setValue 
	 * 
	 * @param bool $value 
	 * @access public
	 * @return void
	 */
	public function setValue($value)
	{
		$this->value = (bool)$value;
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
			'compact' => $this->getValue(),
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

