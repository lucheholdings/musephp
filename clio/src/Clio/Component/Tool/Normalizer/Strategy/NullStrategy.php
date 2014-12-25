<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\NullType;

class NullStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof NullType);
	}

	public function normalize($data, $type = null, Context $context = null)
	{
		return null;
	}

	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof NullType);
	}

	public function denormalize($data, $type, Context $context = null)
	{
		return null;
	}
}
