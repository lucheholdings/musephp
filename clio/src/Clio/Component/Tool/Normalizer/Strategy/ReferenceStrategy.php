<?php
namespace Clio\Component\Tool\Normalizer;

class ReferenceStrategy
{
	public function canNormalize($data, $type)
	{
		return ($type instanceof ReferenceType);
	}

	public function doNormalize($data, $context)
	{
		$type = $this->getCurrentScope()->getType();
		if(!$type instanceof ReferenceType) {
			throw new \InvalidArgumentException(sprintf('ReferenceStrategy requires an instanceof of ReferenceType to doNormalize, but "%s" is given.', get_class($data)));
		}

		return $type->getIdentifierValues($data);
	}
}

