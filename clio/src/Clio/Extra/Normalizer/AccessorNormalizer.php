<?php
namespace Clio\Extra\Normalizer;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Component\Tool\Normalizer\Strategy\PriorityCollection,
	Clio\Component\Tool\Normalizer\Strategy,
	Clio\Extra\Normalizer\Strategy\AccessorStrategy
;

use Clio\Component\Util\Accessor\Schema\AccessorRegistry as SchemaAccessorRegistry;
use Clio\Component\Util\Accessor\Schema\Factory\FieldSchemaAccessorFactory;

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
	static public function createDefault(SchemaAccessorRegistry $accessorRegistry = null)
	{
		if(!$accessorRegistry) {
			$accessorRegistry = SchemaAccessorRegistry::createRegistry(new FieldSchemaAccessorFactory());
		}

		$strategy = new PriorityCollection(array(
			new Strategy\DateTimeStrategy(),
			new Strategy\StdClassStrategy(),
			new AccessorStrategy($accessorRegistry),
			new Strategy\ReferenceStrategy(),
			new Strategy\ScalarStrategy(),
		));

		return new self($strategy);
	}
}

