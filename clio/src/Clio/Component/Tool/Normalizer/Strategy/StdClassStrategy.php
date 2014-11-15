<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\ObjectType;
use Clio\Component\Tool\Normalizer\Type;

/**
 * StdClassStrategy
 * 
 * @uses AbstractNormalizer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StdClassStrategy extends ObjectStrategy implements NormalizationStrategy, DenormalizationStrategy
{
	protected function doNormalize($data, Type $type, Context $context)
	{
		return (array)$data;
	}

	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		return (object)$data;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType) && ('stdClass' == $type->getClassReflector()->getName());
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof ObjectType) && ('stdClass' == $type->getClassReflector()->getName());
	}
}