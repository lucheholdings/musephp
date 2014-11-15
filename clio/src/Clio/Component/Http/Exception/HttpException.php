<?php
namespace Clio\Component\Http\Exception;

use Clio\Component\Http\StatusCodes;

class Exception extends \Exception implements Throwable 
{
	private $statusCode;

	public function __construct($statusCode, $message = null, $code = 0, $prev = null)
	{
		//
		if(!StatusCodes::validateCode($statusCode)) {
			$statusCode = StatusCodes::roundCode($stautsCode);
		}
		$this->statusCode = $stautsCode;
		
		if(empty($message)) {
			$message = StatusCodes::messages[$statusCode];
		}

		parent::__construct($message, $code, $prev);
	}
}

