<?php
namespace Tersichore\Service;

class Twitter extends GenericSocialService
{
	const HOST = 'https://api.twitter.com';

	public function __construct()
	{
		if(!$client) {
			$this->client = ClientFactory::getInstance()->create('https://api.twitter.com');
		} else {
			$this->client->setHost('https://api.twitter.com');
		}

		// Set Auth\GenericOauth1 as Default AuthenticatedService
		$this->setServices(array(
			'authentication' => new GenericOAuth1Service(),
		));
	}

	public function searchTweets(Authenticated $authenticated, $query, $count = 30)
	{
		$uri = '/1.1/search/tweets.json';
		$method = 'GET';

		$request = $this->getClient()->request($uri, $method, array('q' => $query, 'count' => $count);

		return $request->getResponse();
	}
}

