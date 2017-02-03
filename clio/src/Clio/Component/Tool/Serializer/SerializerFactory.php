<?php
namespace Clio\Component\Tool\Serializer;

use Clio\Component\Tool\Serializer\Adapter\AdapterFactoryInterface,
	Clio\Component\Tool\Serializer\Adapter\ClassMapAdapterFactory;

/**
 * SerializerFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SerializerFactory
{
	/**
	 * createSerializer 
	 * 
	 * @param Strategy $strategy 
	 * @access public
	 * @return void
	 */
	public function createSerializer(Strategy $strategy)
	{
		return new Serializer($strategy);
	}
}

