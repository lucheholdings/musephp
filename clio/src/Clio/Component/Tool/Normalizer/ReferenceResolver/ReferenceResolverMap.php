<?php
namespace Clio\Component\Tool\Normalizer\ReferenceResolver;

class ReferenceResolverMap extends Map 
{
	protected function initContainer()
	{
		$this->setValueValidator(new ClassValidator('Clio\Component\Tool\Normalizer\ReferenceResolver'));
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

