<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Provider;

use Terpsichore\Core\Auth\Token;
use Terpsichore\Core\Client\HttpRequest;

/**
 * AbstractHttpProvider 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractHttpProvider extends AbstractProvider
{
	private $urls;

	protected function doGetAuthenticatedUser(Token $token, array $params = array())
	{
		$request = new HttpRequest('GET', $this->getUrl('userinfo'));
		$request->setSecurityToken($token);
		
		$response = $this->getClient()->send($request);

		return $response;
	}

	//public function setClient(Client $client)
	//{
	//	if($client instanceof HttpClient) {
	//		throw new \InvalidArgumentException('HttpProvider only accept HttpClient.');
	//	}
	//	parent::setClient($client);
	//}
    
    public function getUrls()
    {
        return $this->urls;
    }
    
    public function setUrls(array $urls)
    {
        $this->urls = $urls;
        return $this;
    }

	public function getUrl($name)
	{
		return $this->urls[$name];
	}

	public function setUrl($name, $path)
	{
		$this->urls[$name] = $path;
		return $this;
	}
}

