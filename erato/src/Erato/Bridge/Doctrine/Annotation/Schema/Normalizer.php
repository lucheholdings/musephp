<?php
namespace Erato\Bridge\Doctrine\Annotation\Schema;

use Erato\Bridge\Doctrine\Annotation\BaseAnnotation;
use Erato\Bridge\Doctrine\Annotation\Metadata\SchemaMappingAnnotation;

/**
 * Normalizer 
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
class Normalizer extends BaseAnnotation implements SchemaMappingAnnotation 
{
	/**
	 * {@inheritdoc}
	 */
	public function getConfigs()
	{
		return array(
			'services' => array(
				'normalizer'  => $this->getValue(),
			),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTargetMappings()
	{
		return array(
			'normalizer'
		);
	}
}
