<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\MixedType;

class MixedStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof MixedType);
	}

	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$type instanceof MixedType) {
			throw new \InvalidArgumentException(sprintf('MixedStrategy requires an instanceof of ReferenceType to doNormalize, but "%s" is given.', get_class($type)));
		}

		$newType = $context->getTypeRegistry()->resolveMixed($type);

		return $context->getNormalizer()->normalize($data, $newType, $context);
	}

	public function canDenormalize($data, $type, Context $context)
	{
		return ($type instanceof MixedType);
	}

	public function denormalize($data, $type, Context $context = null)
	{
		if(!$type instanceof MixedType) {
			throw new \InvalidArgumentException(sprintf('MixedStrategy requires an instanceof of ReferenceType to doNormalize, but "%s" is given.', get_class($type)));
		}

		$newType = $context->getTypeRegistry()->resolveMixed($type);

		return $context->getNormalizer()->denormalize($data, $newType, $context);
	}
}

