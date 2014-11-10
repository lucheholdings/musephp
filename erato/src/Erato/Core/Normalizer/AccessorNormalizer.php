<?php
namespace Erato\Core\Normalizer;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Strategy\PriorityCollection,
	Clio\Component\Tool\Normalizer\Strategy,
	Erato\Core\Normalizer\Strategy\AccessorStrategy
;
use Clio\Component\Util\Accessor\Factory\BasicClassAccessorFactory;

/**
 * AccessorNormalizer 
 * 
 * @uses Normalizer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AccessorNormalizer extends Normalizer 
{	
	/**
	 * createDefault 
	 * 
	 * @param SchemaAccessorFactory $accessorFactory 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createDefault(SchemaAccessorFactory $accessorFactory = null)
	{
		if(!$accessorFactory) {
			$accessorFactory = BasicClassAccessorFactory::createFactory();
		}
		$strategy = new PriorityCollection(array(
			new Strategy\DateTimeStragegy(),
			new AccessorStrategy($accessorFactory),
			new Strategy\ReferenceStrategy(),
			new Strategy\ScalarStrategy(),
		));
		return new self($strategy);
	}
}

