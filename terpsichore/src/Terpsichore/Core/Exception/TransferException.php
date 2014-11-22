<?php
namespace Terpsichore\Core\Exception;

use Terpsichore\Core\Request;

class TransferException extends \RuntimeException
{
	private $request;

	private $response;

	public function __construct(Request $request, $response = null, $message = '', $code = 0, \Exception $prev = null)
	{
		$this->request = $request;
		$this->response = $response;

		parent::__construct($message, $code, $prev);
	}

	public function getResponseHeaders()
	{
		return null;
	}

	public function getResponseBody()
	{
		return $this->response;
	}

	public function getResponse()
	{
		return $this->response;
	}

    public function getRequest()
    {
        return $this->request;
    }
    
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }
}

