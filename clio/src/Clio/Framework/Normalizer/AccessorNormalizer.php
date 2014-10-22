<?php
namespace Clio\Framework\Normalizer;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Strategy\StrategyCollection,
	Clio\Component\Tool\Normalizer\Strategy\ScalarStrategy,
	Clio\Component\Tool\Normalizer\Strategy\ReferenceStrategy,
	Clio\Framework\Normalizer\Strategy\AccessorStrategy
;
use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;

class AccessorNormalizer extends Normalizer 
{	
	static public function createDefault(SchemaAccessorFactory $accessorFactory = null)
	{
		if(!$accessorFactory) {
			$accessorFactory = BasicClassAccessorFactory::createDefaultFactory();
		}
		$strategy = new StrategyCollection(array(
			new AccessorStrategy($accessorFactory),
			new ReferenceStrategy(),
			new ScalarStrategy(),
		));
		return new self($strategy);
	}
}

