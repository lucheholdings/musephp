<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Util;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientInterface,
	Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\TokenInterface,
	Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\RefreshTokenInterface,
	Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\AuthCodeInterface,
	Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\UserInterface
;
use Clio\Component\Auth\OAuth2\Util\ScopeUtilInterface;

/**
 * StorageUtil 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StorageUtil
{
	private $container;

	/**
	 * scopeUtil 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $scopeUtil;

	/**
	 * __construct 
	 * 
	 * @param ScopeUtilInterface $scopeUtil 
	 * @access public
	 * @return void
	 */
	public function __construct($container)
	{ 
		$this->container = $container;
	}

	/**
	 * setScopeUtil 
	 * 
	 * @param ScopeUtilInterface $scopeUtil 
	 * @access public
	 * @return void
	 */
	public function setScopeUtil(ScopeUtilInterface $scopeUtil)
	{
		$this->scopeUtil = $scopeUtil;
	}

	/**
	 * getScopeUtil 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScopeUtil()
	{
		if(!$this->scopeUtil) {
			$this->scopeUtil = $this->container->get('clio_oauth2_server.scope_util');
		}
		return $this->scopeUtil;
	}

	/**
	 * convertClient 
	 * 
	 * @param ClientInterface $client 
	 * @access public
	 * @return void
	 */
	public function convertClient(ClientInterface $client) 
	{
		return array(
			'client_id' => $client->getClientId(),
			'grant_types' => $client->getAllowedGrantTypes(),
			'redirect_uri' => $client->getRedirectUris(),
			'scope' => $this->getScopeUtil()->fromArray($client->getSupportedScopes()),
			'object' => $client,
		);
	}

	public function convertClientScopesInDomain(array $scopes, $domain)
	{
		if(!empty($scopes)) {
			array_walk($scopes, function(&$v, $k) use ($domain) {
				$v = sprintf('https://%s/%s', $domain , $v);
			});

		}

		return $scopes;
	}

	/**
	 * convertToken 
	 * 
	 * @param TokenInterface $token 
	 * @access public
	 * @return void
	 */
	public function convertToken(TokenInterface $token) 
	{
		return array(
			'client_id' => $token->getClientId(),
			'expires' => $token->getExpiresAt()->getTimestamp(),
			'scope' => $this->getScopeUtil()->fromArray($token->getScopes()),
			'user_id' => $token->getUserId() ?: null,
			'object' => $token,
		);
	}

	/**
	 * convertUser 
	 * 
	 * @param UserInterface $user 
	 * @access public
	 * @return void
	 */
	public function convertUser(UserInterface $user)
	{
		return array(
			'user_id' => $user->getIdentifier(),
			'object' => $user,
		);
	}
}

