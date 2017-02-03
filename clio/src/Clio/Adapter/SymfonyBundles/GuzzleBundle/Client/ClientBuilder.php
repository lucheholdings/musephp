<?php
namespace Clio\Adapter\SymfonyBundles\GuzzleBundle\Client;

/**
 * ClientBuilder 
 *   Builder Class to build ServiceClient
 *   Differ from Guzzle ServiceBuilder, this Builder only create one Service Client.
 *
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientBuilder implements ClientBuilderInterface
{
	/**
	 * factory 
	 *   Create ClientBuilder instance
	 * @param array $configs 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function factory($clientClass, array $configs = array())
	{
		$builder = new static($clientClass, $configs);
		
		return $builder;
	}

	/**
	 * class 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $class;

	/**
	 * params 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $params = array();

	/**
	 * __construct 
	 * 
	 * @param mixed $clientClass 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function __construct($clientClass, array $params = array())
	{
		$this->clientClass = $clientClass;
		$this->params = $params;
	}

	/**
	 * build 
	 *   Build an instanceof ServiceClient
	 * 
	 * @access public
	 * @return void
	 */
	public function build()
	{
		$client = null;

		//
		if(!class_exists($clientClass)) {
			throw new \RuntimeException(sprintf('Client Class "%s" is not exists.', $clientClass));
		}
		
		$class = new \ReflectionClass($clientClass);

		// Call Client::factory with parameters
		$client = $class->getMethod('factory')->invork(null, $this->params);

		return $client;
	}
}

