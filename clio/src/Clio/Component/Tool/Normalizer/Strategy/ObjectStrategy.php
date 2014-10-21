<?php
namespace Clio\Component\Tool\Normalizer;

use Clio\Component\Tool\Normalizer\Context;

/**
 * ObjectStrategy
 * 
 * @uses AbstractNormalizer
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ObjectStrategy extends AbstractStrategy 
{
	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType);
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType);
	}
}
