<?php
namespace Clio\Component\Normalizer\ReferenceResolver;

class ReferenceResolverMap extends Map 
{
	protected function initContainer()
	{
		$this->setValueValidator(new SubclassValidator('Clio\Component\Normalizer\ReferenceResolver'));
	}

	public function resovleReference($object)
	{
		$type = get_class($type);
		return $this->get($type)->resolveReference($object);
	}

	public function resolveObject($type, $reference)
	{
		return $this->get($type)->resolveObject($reference);
	}
}

