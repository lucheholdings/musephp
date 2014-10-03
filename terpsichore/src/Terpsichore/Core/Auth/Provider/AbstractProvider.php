<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Provider;

use Terpsichore\Core\Connection;
use Terpsichore\Core\Auth\Provider as ProviderInterface;
use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Service\GenericClientService;
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
abstract class AbstractProvider extends GenericClientService implements ProviderInterface
{
	/**
	 * responseMappers 
	 * 
	 * @var array
	 * @access private
	 */
	private $responseMappers = array();

	/**
	 * __construct 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection = null, array $options = array())
	{
		$this->options = $options;

		$this->responseMappers = array(
			false => new DummyMapper(),
		);

		parent::__construct($connection);
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
}

