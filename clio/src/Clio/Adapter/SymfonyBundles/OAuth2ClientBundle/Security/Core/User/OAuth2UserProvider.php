<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\Security\Core\User;

# @use Symfony Security Component
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface as SecurityUserInterface;

# @use ApplicationPlatformBootstrapBundle extensions components
use Clio\Component\Auth\OAuth2\User\Provider\OAuth2UserProviderInterface;
use Clio\Component\Auth\OAuth2\Token\ClientTokenInterface;

/**
 * UserProvider 
 *  Provide Login-able users from account 
 *
 * @uses UserProviderInterface
 * @package 
 * @author Yoshi Aoki <yoshi@44services.jp> 
 */
class OAuth2UserProvider 
  implements
  	UserProviderInterface,
	OAuth2UserProviderInterface
{
	/**
	 * fieldname 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $fieldname;

	/**
	 * client
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $client;

    /**
     * __construct 
     * 
     * @param UserManagerInterface $client
     * @access public
     * @return void
     */
    public function __construct($client = null, $fieldname = 'username')
    {
		$this->client = $client;
		$this->fieldname = $fieldname;
    }

	/**
	 * {@inheritDoc}
	 */
	public function supportsClass($class)
	{
		$client = $this->getClient();
		$command = $client->getTokenByGrantPasswordCommand($username, $password);
		$userClass = $command->getResponseClass();

		// check
		return $userClass === $class || is_subclass_of($class, $userClass);
	}

	/**
	 * loadUserByUsername 
	 * 
	 * @param mixed $username 
	 * @access public
	 * @return void
	 */
	public function loadUser($uniqueToken)
	{
		$user = $this->findUser($uniqueToken);
		if(!$user)
			throw new UsernameNotFoundException(sprintf('Username "%s" does not exist.', $username));
	}

	/**
	 * refreshUser 
	 * 
	 * @param SecurityUserInterface $user 
	 * @access public
	 * @return void
	 */
	public function refreshUser(SecurityUserInterface $user)
	{
		// 
		return $user;
	}

	/**
	 * loadUserByUsername
	 * 
	 * @access public
	 * @return void
	 */
	public function loadUserByUsername($username)
	{
		throw new \Exception('OAuth2UserProvider cannot load user by username.');
	}

	/**
	 * loadUserByAccessToken 
	 * 
	 * @param ClientTokenInterface $accessToken 
	 * @access public
	 * @return void
	 */
	public function loadUserByAccessToken(ClientTokenInterface $accessToken)
	{
		$provider = $this->getUserProvider();
		return $provider->loadUserByAccessToken($accessToken);
	}

	/**
	 * getUserLoginField 
	 * 
	 * @access public
	 * @return void
	 */
	public function getUserLoginField()
	{
		return $this->fieldname;
	}

	/**
	 * createUserFromJson 
	 * 
	 * @param mixed $json 
	 * @access public
	 * @return void
	 */
	public function createUserFromJson($json)
	{
		return $this->userManager->createUserFromObject(json_decode($json));
	}

	/**
	 * createUserFromUsername 
	 * 
	 * @param mixed $username 
	 * @access public
	 * @return void
	 */
	public function createUserFromUsername($username)
	{
		return $this->userManager->createUser();
	}
}

