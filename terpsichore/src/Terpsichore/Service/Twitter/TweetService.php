<?php
namespace Terpsichore\Service\Twitter;

use Terpsichore\Core\Service\Http\HttpServiceProvider;

class TweetService extends HttpServiceProvider
{
	public function search($keyword = null, $size = 10, array $extra = array())
	{
		$params = array('count' => $size);
		if($query) {
			$params['q'] = $keyword;	
		}

		$params = array_merge($extra, $params);

		// 
		$request = $this->createRequest(
			array(
				'uri' => '/1.1/search/tweets.json',
				'method' => 'get',
			), 
			$params
		);

		return $this->request($request);
	}

	public function post($body)
	{
		// 
		$request = $this->createRequest(
			array(
				'uri' => '/1.1/statuses/update.json',
				'method' => 'post',
			), 
			array('status' => $params)
		);

		return $this->request($request);
	}
}

