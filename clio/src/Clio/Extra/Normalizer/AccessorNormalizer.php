<?php
namespace Clio\Extra\Normalizer;

use Clio\Component\Tool\Normalizer\Normalizer as BaseNormalizer;
use Clio\Component\Tool\Normalizer\Strategy\PriorityCollection,
	Clio\Component\Tool\Normalizer\Strategy,
	Clio\Extra\Normalizer\Strategy\AccessorStrategy
;

use Clio\Component\Pattern\Registry,
    Clio\Component\Pattern\Registry\Registry as RegistryInterface;
use Clio\Component\Pattern\Loader,
    Clio\Component\Pattern\Loader\Loader as LoaderInterace;

use Clio\Component\Util\Accessor\Registry as AccessorRegistry;
use Clio\Component\Util\Accessor\Loader as AccessorLoader;
use Clio\Component\Util\Accessor\Factory\SchemaAccessorFactory;
/**
 * AccessorNormalizer 
 * 
 * @uses Normalizer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AccessorNormalizer extends BaseNormalizer 
{	
	/**
	 * createDefault 
	 * 
	 * @param SchemaAccessorFactory $accessorFactory 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createDefault(RegistryInterface $accessorRegistry)
	{
		$strategy = new PriorityCollection(array(
			new Strategy\MixedStrategy(),
			new Strategy\DateTimeStrategy(),
			new Strategy\StdClassStrategy(),
			new AccessorStrategy($accessorRegistry),
			//new Strategy\ArrayStrategy(),
			new Strategy\ReferenceStrategy(),
			//new Strategy\ScalarStrategy(),
		));

		return new self($strategy);
	}
}

