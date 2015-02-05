<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Util\Type\Type,
	Clio\Component\Util\Type as Types
;
use Clio\Component\Tool\Normalizer\Context;

class ScalarStrategy extends AbstractStrategy implements NormalizationStrategy, DenormalizationStrategy
{
	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return $type->isType(Types\PrimitiveTypes::TYPE_SCALAR);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doNormalize($data, Type $type, Context $context)
	{
		return $data;
	}

	/**
	 * {@inheritdoc}
	 */
	public function canDenormalize($data, $type, Context $context)
	{
		return $type->isType(Types\PrimitiveTypes::TYPE_SCALAR);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		return $data;
	}
}

