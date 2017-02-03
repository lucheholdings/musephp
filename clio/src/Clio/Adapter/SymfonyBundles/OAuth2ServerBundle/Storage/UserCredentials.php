<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage;

use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\UserProviderStrategy;
use OAuth2\Storage as OAuth2Storage;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Util\StorageUtil;

/**
 * UserCredentials 
 * 
 * @uses Storage
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class UserCredentials extends StrategicStorage implements 
	OAuth2Storage\UserCredentialsInterface
{
	protected $encoderFactory;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(UserProviderStrategy $strategy, StorageUtil $storageUtil = null)
	{
		parent::__construct($strategy, $storageUtil);
	}

	public function setEncoderFactory(EncoderFactoryInterface $encoderFactory)
	{
		$this->encoderFactory = $encoderFactory;
		return $this;
	}

	public function getEncoderFactory()
	{
		if(!$this->encoderFactory) {
			throw new \RuntimeException('EncoderFactory is not initialized yet. Please initialize by setEncoderFactory.');
		}
		return $this->encoderFactory;
	}

	public function getEncoder($user)
	{
		return $this->getEncoderFactory()->getEncoder($user);
	}

    /* OAuth2_Storage_UserCredentialsInterface */
    public function checkUserCredentials($username, $password)
    {
        if ($user = $this->getUser($username)) {
			$salt = $user->getSalt();
            $encodedPassword = $this->getEncoder($user)->encodePassword($password, $salt);
			
			return $encodedPassword === $user->getPassword();
        }

        return false;
    }

    public function getUserDetails($username)
    {
        return $this->getStorageUtil()->convertUser($this->getUser($username));
    }

	public function getUserProvider()
	{
		return $this->getStrategy();
	}

    public function getUser($username)
    {
		return $this->getUserProvider()->loadUserByUsername($username);
    }
}

