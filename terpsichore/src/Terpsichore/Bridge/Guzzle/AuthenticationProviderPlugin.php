<?php
namespace Terpsichore\Bridge\Guzzle;

use Guzzle\Common\Event,
	Guzzle\Common\Collection
;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AuthenticationProviderPlugin implements EventSubscriberInterface
{
	/**
	 * authenticationProvider 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $authenticationProvider;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'request.before_send' => array('onRequestBeforeSend', -1000),
			'request.exception' => array('onRequestException', 0),
        );
    }

	public function onRequestBeforeSend(Event $event)
	{
		if(!$this->isAuthenticated()) {
			// Authenticate by Provider
			$this->setAuthentication($this->getAuthenticationProvider()->authenticate());
		}

		$request = $event['request'];
		$this->updateAuthenticatedHeader($request);
	}

	protected function updateAuthenticatedHeader($request)
	{
		if($authenticated instanceof OAuth2Token) {
			foreach($authenticated->getRequestHeaders() as $key => $value) {
				$request->setHeader($key, $value);
			}
		}
	}

	public function onRequestException(Event $event)
	{
	}
    
    /**
     * {@inheritdoc}
     */
    public function getAuthenticationProvider()
    {
        return $this->authenticationProvider;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setAuthenticationProvider($authenticationProvider)
    {
        $this->authenticationProvider = $authenticationProvider;
        return $this;
    }
}

