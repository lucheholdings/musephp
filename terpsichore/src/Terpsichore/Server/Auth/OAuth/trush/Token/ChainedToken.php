<?php
namespace Terpsichore\Server\Auth\OAuth\Token;

/**
 * ChainedToken 
 *   ClientToken which inherit ServerToken Information.
 *   This token is special token to chain OAuth Request from Provider to Provider with origin client request.
 * 
 * @uses Token
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ChainedToken extends ServerToken
  implements
    ChainedTokenInterface
{
	/**
	 * expiresIn 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $expiresIn;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(ClientTokenInterface $token = null)
	{
		// Lets copy AccessToken
		$this->token = $token->getAccessToken();
		$this->scopes = $token->getScopes();
		$this->expiresAt = new \DateTime('@' . (time() + $token->getExpiresIn()));
	}
}

