<?php
namespace Terpsichore\Bridge\Guzzle;

use Terpsichore\Core\Connection\Factory as ConnectionFactory;

/**
 * GuzzleHttpConnectionFactory 
 * 
 * @uses ConnectionFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class GuzzleHttpConnectionFactory implements ConnectionFactory 
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
		return new GuzzleHttpConnection();
	}
}

