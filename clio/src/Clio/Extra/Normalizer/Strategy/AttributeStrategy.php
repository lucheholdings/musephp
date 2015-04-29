<?php
namespace Clio\Extra\Normalizer\Strategy;

use Clio\Component\Normalizer\Strategy\InterfaceStrategy;
use Clio\Component\Normalizer\Strategy\NormalizationStrategy,
	Clio\Component\Normalizer\Strategy\DenormalizationStrategy
;
use Clio\Component\Normalizer\Context;
use Clio\Component\Normalizer\Type;

class AttributeStrategy extends InterfaceStrategy implements NormalizationStrategy, DenormalizationStrategy 
{

	protected function doNormalize($data, Type $type, Context $context)
	{
		return $data->getValue();
	}

	protected function doDenormalize($data, Type $type, Context $context, $object)
	{
		if($object) {
			$object->setValue($data);
		}

		return $object;
	}


	public function getInterfaceName()
	{
		return 'Clio\Component\Attribute\Attribute';
	}
}

