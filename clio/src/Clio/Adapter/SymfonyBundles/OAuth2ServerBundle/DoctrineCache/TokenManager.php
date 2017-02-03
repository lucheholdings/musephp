<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\DoctrineCache;

use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\TokenInterface,
	Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Storage\Strategy\TokenManagerStrategy;
/**
 * TokenManager 
 * 
 * @uses DoctrineCacheManager
 * @uses TokenManager
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenManager extends DoctrineCacheStorage implements TokenManagerStrategy
{
	/**
	 * createToken 
	 * 
	 * @access public
	 * @return void
	 */
	public function createToken()
	{
        $class = $this->getClass();

		if(is_string($class) && (!class_exists($class))) {
			throw new \Exception(sprintf('Class "%s" is not exists.', $class));
		}
        return new $class();
	}

	/**
	 * findOneByToken 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function findOneByToken($token)
	{
		$serializedToken = $this->getCache()->fetch($this->getIdentifier($token));

		if($logger = $this->getLogger()) {
			$logger->info(sprintf('AccessToken "%s" is found.', $this->getIdentifier($token)));
		} 

		return $serializedToken;
	}

	/**
	 * save 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function save($token)
	{
		$ttl = $token->getExpiresIn();

		$serialized = $token;

		if(!$ret = $this->getCache()->save($this->getIdentifier($token), $serialized, $ttl)) {
			if($this->getCache() instanceof \Doctrine\Common\Cache\MemcachedCache) {
				throw new \Exception(sprintf('Failed to write in cache. [%s]', json_encode($this->getCache()->getMemcached()->getResultMessage())));
			}
			throw new \Exception('Failed to write in cache.');
		}

		if($logger = $this->getLogger()) {
			$logger->info(sprintf('AccessToken "%s" is updated', $this->getIdentifier($token)));
		}
	}

	/**
	 * delete 
	 * 
	 * @param TokenInterface $token 
	 * @access public
	 * @return void
	 */
	public function delete($token)
	{
		if(!$token instanceof TokenInterface) {
			throw new \InvalidArgumentException('parameter token has to be an instanceof TokenInterface.');
		}
		
		$this->getCache()->delete($this->getIdentifier($token));

		if($logger = $this->getLogger()) {
			$logger->info(sprintf('AccessToken "%s" is deleted', $this->getIdentifier($token)));
		}
	}

	/**
	 * getIdentifier 
	 * 
	 * @param string|TokenInterface $token 
	 * @access protected
	 * @return void
	 */
	protected function getIdentifier($token)
	{
		if($token instanceof TokenInterface) {
			return $token->getToken();
		} else if(is_string($token)) {
			return $token;
		}
	}
}

