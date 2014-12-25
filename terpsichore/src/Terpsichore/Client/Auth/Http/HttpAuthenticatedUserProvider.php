<?php
namespace Terpsichore\Client\Auth\Http;

use Terpsichore\Client\Auth\User,
	Terpsichore\Client\Auth\UserProvider;
use Terpsichore\Client\Service\Http\HttpSimpleClientService;
use Clio\Component\Tool\ArrayTool\Mapper;

class HttpAuthenticatedUserProvider extends HttpSimpleClientService implements UserProvider 
{
	private $responseMap;

	/**
	 * __construct 
	 * 
	 * @param mixed $url 
	 * @param array $options 
	 * @param array $responseMap 
	 * @access public
	 * @return void
	 */
	public function __construct($url, array $options, array $responseMap = array(), Connection $connection = null)
	{
		parent::__construct($url, 'get', $options, $connection, 'user');

		$this->responseMap = $responseMap;
	}

	/**
	 * userinfo 
	 * 
	 * @access public
	 * @return mixed 
	 */
	public function get(array $params = array())
	{
		$response = $this->call($params);

		return $response;
	}

	/**
	 * getAuthenticatedUser 
	 * 
	 * @access public
	 * @return User
	 */
	public function getAuthenticatedUser()
	{
		$response = $this->get();
		if(is_array($response) && $this->responseMap) {
			$mapper = new Mapper\InverseKeyMapper($this->responseMap);

			$response = $mapper->map($response);
		}

		return new User(isset($response['id']) ? $response['id'] : $response['username'], $response);
	}
    
    public function getResponseMap()
    {
        return $this->responseMap;
    }
    
    public function setResponseMap($responseMap)
    {
        $this->responseMap = $responseMap;
        return $this;
    }
}

