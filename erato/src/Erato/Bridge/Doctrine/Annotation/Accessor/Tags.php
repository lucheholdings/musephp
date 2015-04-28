<?php
namespace Erato\Bridge\Doctrine\Annotation\Accessor;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Tags 
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
class Tags extends BaseAnnotation implements SchemaMappingAnnotation 
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
			'tag_set'
		);
	}
}