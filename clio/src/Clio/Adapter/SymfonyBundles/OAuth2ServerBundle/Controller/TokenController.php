<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * TokenController 
 * 
 * @uses Controller
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TokenController extends Controller
{
    /**
     * @param Request $request
     * @return type
     */
    public function tokenAction(Request $request)
    {
		// get the oauth server (@see OAuth2/ServerBundle/Resources/config/services.xml)
		$server = $this->get('clio_oauth2_server.server');

		// get the oauth response object (@see OAuth2/ServerBundle/Resources/config/services.xml)
		$response = $this->get('clio_oauth2_server.response');
		// let the oauth2-server-php library do all the work!
		return $server->handleTokenRequest($this->get('clio_oauth2_server.request'), $response);
    }


	/**
	 * tokenInfoAction 
	 *   Get the token info for given access_token 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function tokenInfoAction(Request $request)
	{
		$token = null;
		if($request->query->has('access_token')) {
			$token = $request->query->get('access_token');
		} else {
			$token = $request->request->get('access_token');
		}

		if(!$token) {
			throw new \Exception('Invalid Request');
		}


		// Get Matched Token
		$token = $this->get('clio_oauth2_server.storage.access_token')->getAccessToken($token);
		if(!$token) {
			throw new \Exception('Token not exists');
		}

		return array('audience' => $token['client_id'], 'scope' => $token['scope'], 'expires_in' => $token['expires'] - time(), );
	}

	/**
	 * filterScopes 
	 * 
	 * @param mixed $token 
	 * @access protected
	 * @return void
	 */
	protected function filterScopes($token)
	{
		return $token;
	}
}
