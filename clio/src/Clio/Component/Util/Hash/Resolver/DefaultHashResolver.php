<?php
namespace Clio\Component\Util\Hash\Resolver;

/**
 * DefaultHashResolver 
 * 
 * @uses HashResolverInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DefaultHashResolver implements HashResolverInterface 
{
	/**
	 * resolve 
	 * 
	 * @access public
	 * @return void
	 */
	public function resolve()
	{
		// Call Singleton of the HashUtil
		return call_user_func_array('Clio\Component\Util\Hash\HashUtil::generateHash', func_get_args());
	}
}

