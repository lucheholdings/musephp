<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

use Clio\Component\Tool\Normalizer\Context;
use Clio\Component\Util\Type as Types;

class MixedStrategy implements NormalizationStrategy, DenormalizationStrategy 
{
	public function canNormalize($data, $type, Context $context)
	{
		return $type->isType(Types\PrimitiveTypes::TYPE_MIXED);
	}

	public function normalize($data, $type = null, Context $context = null)
	{
		if(!$type->isType(Types\PrimitiveTypes::TYPE_MIXED)) {
			throw new \InvalidArgumentException(sprintf('MixedStrategy only accept type "mixed", but "%s[%s]" is given.', get_class($type), $type->getName()));
		}

		$type = $context->getTypeResolver()->resolve($type, array('data' => $data));

		return $context->getNormalizer()->normalize($data, $type, $context);
	}

	public function canDenormalize($data, $type, Context $context)
	{
		return ($type->isType(Types\PrimitiveTypes::TYPE_MIXED));
	}

	public function denormalize($data, $type, Context $context = null)
	{
		if(!$type->isType(Types\PrimitiveTypes::TYPE_MIXED)) {
			throw new \InvalidArgumentException(sprintf('MixedStrategy only accept type "mixed", but "%s[%s]" is given.', get_class($type), $type->getName()));
		}

		$type = $context->getTypeResolver()->resolve($type, array('data' => $data));

		return $context->getNormalizer()->denormalize($data, $type, $context);
	}
}

