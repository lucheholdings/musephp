<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Accessor;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Attributes 
 * 
 * @uses BaseAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target("CLASS")
 * @Attributes({
 *   @Attribute("value", type = "string"),
 * })
 */
class Attributes extends BaseAnnotation implements SchemaMappingAnnotation 
{
	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'field'  => $this->getValue(),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTargetMappings()
	{
		return array(
			'attribute_map'
		);
	}
}
