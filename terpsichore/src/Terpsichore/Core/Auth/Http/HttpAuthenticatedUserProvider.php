<?php
namespace Terpsichore\Core\Auth\Http;

use Terpsichore\Core\Auth\User,
	Terpsichore\Core\Auth\UserProvider;
use Terpsichore\Core\Service\Http\HttpSimpleClientService;
use Clio\Component\Tool\ArrayTool\InverseKeyMapper;

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
	public function userinfo()
	{
		$response = $this->call();

		if(is_array($response) && $this->responseMap) {
			$mapper = new InverseKeyMapper($this->responseMap);
			$response = $mapper->map($response);
		}
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
		$response = $this->userinfo();

		return new User(isset($response['id']) ? $response['id'] : $response['username'], $response);
	}
}

