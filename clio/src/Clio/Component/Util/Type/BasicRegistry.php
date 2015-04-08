<?php
namespace Clio\Component\Util\Type;

use Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader,
	Clio\Component\Pattern\Registry\Loader\LoaderCollection
;

/**
 * BasicRegistry 
 *    BasicRegistry is an ActualTypeRegistry which only  
 * @uses BaseRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BasicRegistry extends BaseRegistry 
{
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
	public function __construct()
	{
		parent::__construct(
				new LoaderCollection(array(
					new MappedFactoryLoader(new Factory\ClassTypeFactory()),
					new MappedFactoryLoader(new Factory\PrimitiveTypeFactory()),
				))
			);
	}
}

