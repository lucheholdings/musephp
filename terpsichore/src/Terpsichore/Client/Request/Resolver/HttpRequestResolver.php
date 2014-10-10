<?php
namespace Terpsichore\Client\Request\Resolver;

use Terpsichore\Client\Request;

class HttpRequestResolver 
{
	/**
	 * acceptableHttpHeaders 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $acceptableHttpHeaders = array(
		'accept' => 'Accept',
		'accept-charset' => 'Accept-Charset',
		'accept-encoding' => 'Accept-Encoding',
		'accept-language' => 'Accept-Language',
		'accept-datetime' => 'Accept-Datetime',
		'authorization' => 'Authorization',
		'cache-control' => 'Cache-Control',
		'connection' => 'Connection',
		'cookie' => 'Cookie',
		'content-length' => 'Content-Length',
		'content-md5' => 'Content-MD5',
		'content-type' => 'Content-Type',
		'date' => 'Date',
		'expect' => 'Expect',
		'from' => 'From',
		'host' => 'Host',
		'if-match' => 'If-Match',
		'if-modified-since' => 'If-Modified-Since',
		'if-none-match' => 'If-None-Match',
		'if-range' => 'If-Range',
		'if-unmodified-since' => 'If-Unmodified-Since',
		'max-forwards' => 'Max-Forwards',
		'origin' => 'Origin',
		'pragma' => 'Pragma',
		'proxy-authorization' => 'Proxy-Authorization',
		'range' => 'Range',
		'referer' => 'Referer',
		'te' => 'TE',
		'user-agent' => 'User-Agent',
		'upgrade' => 'Upgrade',
		'via' => 'Via',
		'warning' => 'Warning',
		'x-requested-with' => 'X-Requested-With',
		'dnt' => 'DNT',
		'x-forwarded-for' => 'X-Forwarded-For',
		'x-forwarded-proto' => 'X-Forwarded-Proto',
		'front-end-https' => 'Front-End-Https',
		'x-att-deviceid' => 'X-ATT-DeviceId',
		'x-wap-profile' => 'X-Wap-Profile',
		'proxy-connection' => 'Proxy-Connection',
	);

	/**
	 * prepare 
	 * 
	 * @param Request $request 
	 * @access protected
	 * @return void
	 */
	protected function prepare(Request $request)
	{
		// Validate Method
		$request->setHeader('method', $this->validateMethod($request->getHeader('method', 'GET')));

		$request->clean();
	}

	/**
	 * resolveUri 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function resolveUri(Request $request)
	{
		if($request->isDirty()) {
			$this->prepare($request);
		}

		return $request->getHeader('uri');
	}

	/**
	 * resolveMethod 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function resolveMethod(Request $request)
	{
		if($request->isDirty()) {
			$this->prepare($request);
		}

		return $request->getHeader('method', 'GET');
	}

	/**
	 * resolveHeaders 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function resolveHeaders(Request $request)
	{
		if($request->isDirty()) {
			$this->prepare($request);
		}

		$headers = array();
		foreach($request->getHeaders() as $name => $value) {
			if($value && ($headerName = $this->isAcceptableHttpHeader($name))) {
				$headers[$headerName] = $value;
			}
		}
		return $headers;
	}

	/**
	 * resolveBody 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	public function resolveBody(Request $request)
	{
		if($request->isDirty()) {
			$this->prepare($request);
		}

		return $request->getBody();
	}

	/**
	 * isAcceptableHttpHeader 
	 * 
	 * @param mixed $name 
	 * @access protected
	 * @return void
	 */
	protected function isAcceptableHttpHeader($name)
	{
		if(isset($this->acceptableHttpHeaders[strtolower($name)])) {
			return $this->acceptableHttpHeaders[strtolower($name)];
		}

		return false;
	}

	/**
	 * addAcceptableHttpHeader 
	 * 
	 * @param mixed $header 
	 * @access public
	 * @return void
	 */
	public function addAcceptableHttpHeader($header)
	{
		$idx = strtolower($header);
		$this->acceptableHttpHeaders[$idx] = $header;

		return $this;
	}

	/**
	 * removeAcceptableHttpHeader 
	 * 
	 * @param mixed $header 
	 * @access public
	 * @return void
	 */
	public function removeAcceptableHttpHeader($header)
	{
		$idx = strtolower($header);
		if(isset($this->acceptableHttpHeaders[$idx])) {
			unset($this->acceptableHttpHeaders[$idx]);		
		}

		return $this;
	}

	/**
	 * validateMethod 
	 * 
	 * @param mixed $method 
	 * @access protected
	 * @return void
	 */
	protected function validateMethod($method)
	{
		$method = strtoupper($method);

		switch($method) {
		case 'POST':
		case 'DELETE':
		case 'PATCH':
		case 'HEAD':
		case 'OPTIONS':
		case 'PUT':
		case 'LINK':
		case 'UNLINK':
		case 'TRACE':
			break;
		case 'GET':
		default:
			$method = 'GET';
			break;
		}
		return $method;
	}
}

