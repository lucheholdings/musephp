<?php
namespace Erato\Bridge\Doctrine\Annotation\Normalizer;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\FieldMappingAnnotation;

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
			'ignore'  => true,
		);
	}

	public function getTargetMappings()
	{
		return array(
			'normalizer',
		);
	}
}

