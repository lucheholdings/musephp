<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Component\Security\Core\Exception\AccessDeniedException;

use Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Form\AuthorizationForm;
use Clio\Component\Web\Exception as HttpException;

class AuthorizeController extends Controller
{
    /**
     * @var \Clio\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientInterface
     */
    private $client;

    /**
     * authorizeAction 
     * 
     * @param Request $request 
     * @access public
     * @return void
	 * 
     */
    public function authorizeAction(Request $request)
    {
		$isAccepted = null;
		$user = $this->get('security.context')->getToken()->getUser();

		if(!$user instanceof UserInterface) {
			throw new AccessDeniedException('This user does not have access to this section.');
		}

        if (true === $this->container->get('session')->get('_clio_oauth2_server.ensure_logout')) {
            $this->container->get('session')->invalidate(600);
            $this->container->get('session')->set('_clio_oauth2_server.ensure_logout', true);
        }
	
		$server = $this->get('clio_oauth2_server.server');
		$response = $this->get('clio_oauth2_server.response');

		$form = $this->createForm(new AuthorizationForm());
		if(!$request->isMethod('POST')) {
			if (!$server->validateAuthorizeRequest($this->get('clio_oauth2_server.request'), $response)) {
				if($this->container->getParameter('kernel.debug')) {
					$response->setStatusCode(400);
					$response->headers->remove('location');
				}
				return $response;
			}
			// 
			if(!$request->query->has('client_id')) {
				throw HttpException::create(400);
			}
			
			$clientManager = $this->get('clio_oauth2_server.storage_strategy.client');
			$client = $clientManager->findOneByClientId($request->get('client_id'));
			if(!$client) {
				// 
				throw HttpException::create(400, 'Invalid Client ID given');
			}
			
			$data = array(
				'client_id' => $client->getClientId(),
				'redirect_uri' => $request->query->get('redirect_uri'),
				'response_type' => $request->query->get('response_type'),
			);
			$form->setData($data);
			return $this->render('ClioOAuth2ServerBundle:Authorization:authorize.html.twig', array('form' => $form->createView(), 'client' => $client));
		} else {
			// 
			$form->handleRequest($request);
		
			if($form->get('allow')->isClicked()) {
				$isAccepted = true;
			} else {
				$isAccepted = false;
			}

			// merge data 
			$request->query->add($form->getData());

			$server->handleAuthorizeRequest($this->get('clio_oauth2_server.request'), $response, $isAccepted);
			
			return $response;
		}
    }
}
