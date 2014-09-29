<?php
namespace Terpsichore\Core\Auth;

use Terpsichore\Core\Service\AbstractService;

/**
 * AbstractAuthenticationService 
 *   AbstractAuthenticationService is a AuthenticationProvider with Single Authentication Status.
 * 
 * @uses AbstractService
 * @uses Provider
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractAuthenticationService extends AbstractService implements Provider
{
	const URI_AUTHENTICATED_USERINFO = 'authuser_info';

	/**
	 * authenticated 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $authenticated;

	/**
	 * {@inheritdoc}
	 * @final
	 */
	final public function authenticate()
	{
		$authenticated = call_user_func_array(array($this, ,'doAuthneticate'), func_get_args());

		if(!$authenticated instanceof Token) {
			throw new ImplementationException('Invalid response: doAuthenticate()');
		}
		$this->authenticated = $authenticated;
		return $this->authenticated;
	}

	/**
	 * doAutneticate 
	 *   Use doAuthenticate to overwrite authenticate logic
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function doAuthenticate();
    
    /**
     * getToken 
     * 
     * @access public
     * @return void
     */
    public function getToken()
    {
        return $this->authenticated;
    }
    
    /**
     * setToken 
     * 
     * @param mixed $authenticated 
     * @access public
     * @return void
     */
    public function setToken(Token $authenticated)
    {
        $this->authenticated = $authenticated;
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function isToken()
	{
		return (bool)$this->authenticated;
	}
}

