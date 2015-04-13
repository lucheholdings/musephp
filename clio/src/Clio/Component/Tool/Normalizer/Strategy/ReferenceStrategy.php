<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Tool\Normalizer\Type\Types;

class ReferenceStrategy implements NormalizationStrategy 
{
	public function canNormalize($data, $type)
	{
		return ($type->isType(Types::TYPE_REFERENCE));
	}

	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$type->isType(Types::TYPE_REFERENCE)) {
			throw new \InvalidArgumentException(sprintf('ReferenceStrategy requires type "reference" for doNormalize. Type "%s" is  not a "reference" type.', get_class($type)));
		}

		return $type->getIdentifierValues($data);
	}
}

