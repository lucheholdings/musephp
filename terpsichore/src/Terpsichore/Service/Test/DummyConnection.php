<?php
namespace Terpsichore\Service\Test;

use Terpsichore\Core\Connection\AbstractConnection;
use Terpsichore\Core\Request;

class DummyConnection extends AbstractConnection
{
	private $responses = array();

	public function send(Request $request)
	{
		if(count($this->responses) > 0)
			return array_shift($this->responses);
		return null;
	}
    
    public function getResponses()
    {
        return $this->responses;
    }
    
    public function addResponse($response)
    {
		array_push($this->responses, $response);
        return $this;
    }
}

