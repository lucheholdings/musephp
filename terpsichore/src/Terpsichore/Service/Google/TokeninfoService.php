<?php
namespace Terpsichore\Service\Google;

use Terpsichore\Client\Service\Http\HttpSimpleClientService;

/**
 * TokeninfoService 
 * 
 * @uses HttpSimpleClientService
 * @uses TokeninfoProvider
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokeninfoService extends HttpSimpleClientService implements TokeninfoProvider 
{
	const URL = 'https://www.googleapis.com/oauth2/v1/tokeninfo';

	/**
	 * requestToken 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $requestToken;

	/**
	 * __construct 
	 * 
	 * @param Connection $connection 
	 * @param mixed $token 
	 * @param string $name 
	 * @access public
	 * @return void
	 */
	public function __construct(Connection $connection, $token = null, $name = 'tokeninfo')
	{
		parent::__construct(self::URL, 'get', array(), $connection, $name);

		$this->requestToken = $token;
	}

	/**
	 * getStrictOptions 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getStrictOptions()
	{
		$token = $this->getRequestToken();

		if(!$token) {
			throw new \RuntimeException('query access_token is not specified for Google\TokeninfoService.');
		}
		return array_merge(
			parent::getStrictOptions(),
			array(
				'access_token' => $token,
			)
		);
	}
    
    /**
     * getRequestToken 
     * 
     * @access public
     * @return void
     */
    public function getRequestToken()
    {
        return $this->requestToken;
    }
    
    /**
     * setRequestToken 
     * 
     * @param mixed $requestToken 
     * @access public
     * @return void
     */
    public function setRequestToken($requestToken)
    {
        $this->requestToken = $requestToken;
        return $this;
    }


}

