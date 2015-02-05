<?php
namespace Clio\Component\Util\Metadata\Type;

use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader,
	Clio\Component\Pattern\Registry\Loader\LoaderCollection
;

use Clio\Component\Util\Type\Factory\PrimitiveTypeFactory;
use Clio\Component\Util\Metadata\Type\Factory\SchemaTypeFactory;

class BasicRegistry extends BaseRegistry 
{
	public function __construct(SchemaRegistry $schemaRegistry = null)
	{
		parent::__construct(
				new LoaderCollection(array(
					new MappedFactoryLoader(new PrimitiveTypeFactory()),
					new MappedFactoryLoader(new SchemaTypeFactory())
				)),
				$schemaRegistry
			);
	}
}

