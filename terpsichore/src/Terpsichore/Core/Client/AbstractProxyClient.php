<?php
namespace Terpsichore\Core\Client;

use Terpsichore\Core\Auth\Provider as AuthenticationProvider;
use Terpsichore\Core\Client;
/**
 * AbstractProxyClient 
 * 
 * @uses Client
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractProxyClient implements Client 
{
	/**
	 * client 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $client;

	/**
	 * validateClient 
	 *   Validate Client instance 
	 * @param mixed $client 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function validateClient($client);
    
    /**
     * {@inheritdoc}
     */
    public function getClient()
    {
        return $this->client;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }
}

