<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Type as NormalizerTypeInterface;
use Clio\Component\Util\Type as Types;
use Clio\Component\Tool\Normalizer\Context;

/**
 * ScalarStrategy 
 * 
 * @uses AbstractStrategy
 * @uses NormalizationStrategy
 * @uses DenormalizationStrategy
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ScalarStrategy extends AbstractStrategy implements NormalizationStrategy, DenormalizationStrategy
{
	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type)
	{
		return $type->isType(Types\PrimitiveTypes::BASE_TYPE_SCALAR);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doNormalize($data, NormalizerTypeInterface $type, Context $context)
	{
		return $data;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type)
	{
		return $type->isType(Types\PrimitiveTypes::BASE_TYPE_SCALAR);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doDenormalize($data, NormalizerTypeInterface $type, Context $context, $object = null)
	{
		return $data;
	}
}

