<?php
namespace Clio\Component\Normalizer\Strategy;

use Clio\Component\Normalizer\Context;
use Clio\Component\Type\NullType;

class NullStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	public function canNormalize($data, $type)
	{
		return ($type->isType('null'));
	}

	public function normalize($data, $type = null, Context $context = null)
	{
		return null;
	}

	public function canDenormalize($data, $type)
	{
		return ($type->isType('null'));
	}

	public function denormalize($data, $type, Context $context = null)
	{
		return null;
	}
}

