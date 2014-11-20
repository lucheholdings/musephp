<?php
namespace Terpsichore\Core\Request;

/**
 * HttpRequest 
 * 
 * @uses AbstractRequest
 * @uses Request
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class HttpRequest extends Request 
{
	static public function createFromGlobal()
	{
		// Merge Query and Body
		$params = new HttpParameterBag($_GET, $_POST);

		if(function_exists('apache_request_headers')) {
			$headers = apache_request_headers();
		} else {
			self::getHeadersFromGlobalServer();
		}

		return new self($params, $headers);
	}
	
	static protected function getHeaderFromGlobalServer()
	{
		$headers = array();
		foreach ($_SERVER as $name => $value) 
		{ 
			if (substr($name, 0, 5) == 'HTTP_') 
			{ 
				$name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5))))); 
				$headers[$name] = $value; 
			} else if ($name == 'CONTENT_TYPE') { 
				$headers['Content-Type'] = $value; 
			} else if ($name == 'CONTENT_LENGTH') { 
				$headers['Content-Length'] = $value; 
			} 
		} 

		return $headers;
	}
}

