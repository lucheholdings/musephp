<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader,
	Clio\Component\Pattern\Registry\Loader\LoaderCollection
;
use Clio\Component\Util\Type\Loader\MappedTypeFactoryLoader;

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
	public function __construct()
	{
		parent::__construct(
				new LoaderCollection(array(
					new MappedTypeFactoryLoader(new Factory\PrimitiveTypeFactory()),
				))
			);
	}
}

