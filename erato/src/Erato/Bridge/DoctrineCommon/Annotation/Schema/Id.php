<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Schema;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Id 
 * 
 * @uses BaseAnnotation
 * @uses FieldMappingAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Id extends BaseAnnotation implements FieldMappingAnnotation
{

	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'identifier'  => true,
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTargetMappings()
	{
		return array(
			'metadata'
		);
	}
}

