<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Schema;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Serializer 
 * 
 * @uses BaseAnnotation
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 * 
 * @Annotation
 * @Target("CLASS")
 */
class Serializer extends BaseAnnotation implements SchemaMappingAnnotation 
{
	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'services' => array(
				'serializer'  => $this->getValue(),
			)
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
