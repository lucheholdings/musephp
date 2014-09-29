<?php
namespace Terpsichore\Core\Service;

/**
 * TwitterService 
 * 
 * @uses CompositeService
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TwitterService extends GenericSocialService
{
	public function __construct()
	{
		if(!$client) {
			$this->client = ClientFactory::getInstance()->create('https://api.twitter.com');
		} else {
			$this->client->setHost('https://api.twitter.com');
		}

		// Set Auth\Services\TwitterService as Default AuthenticatedService
		// 
		$this->setServices(array(
			'auth' => new GenericOAuth1Service(),

	}

	public function searchTweets($query, $count = 30)
	{
		$uri = '/1.1/search/tweets.json';
		$method = 'GET';

		$request = $this->getClient()->request($uri, $method, array('q' => $query, 'count' => $count);

		return $request->getResponse();
	}
}

