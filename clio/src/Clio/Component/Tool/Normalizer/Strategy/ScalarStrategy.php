<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Tool\Normalizer\Type\ScalarType;
use Clio\Component\Tool\Normalizer\Context;

class ScalarStrategy extends AbstractStrategy implements NormalizationStrategy, DenormalizationStrategy
{
	/**
	 * {@inheritdoc}
	 */
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof ScalarType);
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
		return ($type instanceof ScalarType);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function doDenormalize($data, Type $type, Context $context, $object = null)
	{
		return $data;
	}
}

