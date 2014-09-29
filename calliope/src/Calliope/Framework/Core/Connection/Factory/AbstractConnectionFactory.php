<?php
namespace Calliope\Framework\Core\Connection\Factory;

/**
 * AbstractConnectionFactory 
 * 
 * @uses ConnectionFactoryInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractConnectionFactory implements ConnectionFactoryInterface
{
	/**
	 * create 
	 * 
	 * @access public
	 * @return void
	 */
	public function create()
	{
		return call_user_func_array(
			array($this, 'createConnection'),
			func_get_args()
		);
	}
}

