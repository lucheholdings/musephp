<?php
namespace Terpsichore\Bridge\Buzz;

use Terpsichore\Client\Connection\Factory as ConnectionFactory;

/**
 * BuzzHttpConnectionFactory 
 * 
 * @uses ConnectionFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class BuzzHttpConnectionFactory implements ConnectionFactory 
{
	/**
	 * createConnection 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createConnection(array $options = array())
	{
		return new BuzzHttpConnection();
	}
}

