<?php
namespace Erato\Core\Type;

use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader,
	Clio\Component\Pattern\Registry\Loader\LoaderCollection
;
use Clio\Component\Util\Type\Loader\MappedTypeFactoryLoader;

use Clio\Component\Util\Type\Factory\PrimitiveTypeFactory;
use Clio\Extra\Type\Factory\TypeFactory as ExtensionalTypeFactory;
use Erato\Core\Type\Factory\SchemaTypeFactory;

use Clio\Component\Util\Metadata\Type\BaseRegistry;

/**
 * BasicRegistry 
 * 
 * @uses BaseRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicRegistry extends BaseRegistry 
{
	public function __construct(SchemaRegistry $schemaRegistry = null)
	{
		parent::__construct(
				new LoaderCollection(array(
					new MappedTypeFactoryLoader(new PrimitiveTypeFactory()),
					new MappedTypeFactoryLoader(new ExtensionalTypeFactory()),
					//new MappedTypeFactoryLoader(new Factory\ExtraTypeFactory()),
					new MappedTypeFactoryLoader(new SchemaTypeFactory())
				)),
				$schemaRegistry
			);
	}
}
