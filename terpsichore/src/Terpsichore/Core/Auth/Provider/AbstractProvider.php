<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Provider;

use Terpsichore\Core\Auth\Provider as ProviderInterface;
use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Service\AbstractClientService;
use Terpsichore\Core\Auth\User;

use Clio\Component\Tool\ArrayTool\KeyMapper,
	Clio\Component\Tool\ArrayTool\InverseMapper;
use Clio\Component\Tool\ArrayTool\DummyMapper;

/**
 * AbstractProvider 
 * 
 * @uses Provider
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractProvider extends AbstractClientService implements ProviderInterface
{
	private $responseMappers = array();

	/**
	 * __construct 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->options = $options;

		$this->responseMappers = array(
			false => new DummyMapper(),
		);

		parent::__construct();
	}

	/**
	 * {@inheritdoc}
	 * @final
	 */
	final public function authenticate(Token $token)
	{
		if($token->isAuthenticated()) {
			return $token;
		}

		// Authenticate.
		$authenticated = $this->doAuthenticate($token);

		if(!$authenticated instanceof Token) {
			throw new ImplementationException('Invalid response: doAuthenticate() has to return TokenInterface.');
		}

		return $authenticated;
	}

	/**
	 * doAutneticate 
	 *   Use doAuthenticate to overwrite authenticate logic
	 * 
	 * @abstract
	 * @access protected
	 * @return Token
	 */
	abstract protected function doAuthenticate(Token $token);

	public function setResponseMappers(array $maps)
	{
		foreach($maps as $type => $map) {
			$this->setresponseMapper($type, $map);
		}
		return $this;
	}

	public function setResponseMapper($type, array $map)
	{
		$this->responseMappers[$type] = new InverseMapper(new KeyMapper($map));

		return $this;
	}

	public function getResponseMapper($type)
	{
		if(!isset($this->responseMappers[$type])) {
			return $this->responseMappers[false];
		}
		return $this->responseMappers[$type];
	}

	public function getAuthenticatedUser(Token $token, array $params = array())
	{
		if(!$token->isAuthenticated()) {
			throw new \Exception('Unauthorized token to get user.');
		}

		// Get User.
		$response = $this->doGetAuthenticatedUser($token, $params);

		return $this->convertUserInfo($response);
	}

	abstract protected function doGetAuthenticatedUser(Token $token, array $params = array());

	protected function convertUserInfo(array $userInfo)
	{
		$data = $this->getResponseMapper('userinfo')->map($userInfo);

		$id = $username = null;

		if(isset($data['id'])) {
			$id = $data['id'];
			unset($data['id']);
		}

		if(isset($data['username'])) {
			$username = $data['username'];
			unset($data['username']);
		}

		if(!$id) {
			$id = $username;
		}

		return new User($id, $data);
	}
}

