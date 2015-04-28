<?php
namespace Erato\Bridge\Doctrine\Annotation\Serializer;

use Erato\Bridge\Doctrine\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Ignore 
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
class Ignore implements FieldMappingAnnotation 
{
	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'ignored' => true,
		);
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
