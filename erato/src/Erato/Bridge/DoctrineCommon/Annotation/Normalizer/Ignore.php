<?php
namespace Erato\Bridge\DoctrineCommon\Annotation\Normalizer;

use Erato\Bridge\DoctrineCommon\Annotation\BaseAnnotation;
use Erato\Bridge\DoctrineCommon\Annotation\Metadata\FieldMappingAnnotation;

/**
 * Ignore 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 *
 * @Annotation
 * @Target({"PROPERTY"})
 */
class Ignore extends BaseAnnotation implements FieldMappingAnnotation 
{
	public function getConfigs()
	{
		return array(
			'ignore'  => (bool)$this->getValue(),
		);
	}

	public function getTargetMappings()
	{
		return array(
			'normalizer',
		);
	}
}

