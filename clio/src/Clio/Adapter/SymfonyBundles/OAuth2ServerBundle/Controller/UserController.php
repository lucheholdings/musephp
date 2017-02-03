<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * UserController 
 * 
 * @uses Controller
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class UserController extends Controller
{
	/**
	 * userinfoAction 
	 *   Get the userinfo for current user
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function userinfoAction(Request $request)
	{
		// Get Session User 
		$user = $this->getUser();
		if(!$user) {
			throw new AccessDeniedHttpException('Access Token is not related with UserCredentials.');
		}

		return array('id' => $user->getId());
	}
}
