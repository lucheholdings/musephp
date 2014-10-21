<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\ReferenceType;

class ReferenceStrategy implements NormalizationStrategy 
{
	public function canNormalize($data, $type, Context $context)
	{
		return ($type instanceof ReferenceType);
	}

	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$type instanceof ReferenceType) {
			throw new \InvalidArgumentException(sprintf('ReferenceStrategy requires an instanceof of ReferenceType to doNormalize, but "%s" is given.', get_class($type)));
		}

		return $type->getIdentifierValues($data);
	}
}

