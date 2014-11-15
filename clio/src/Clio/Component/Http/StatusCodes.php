<?php
namespace Clio\Component\Http;

use Clio\Component\Exception\InvalidArgumentException;
/**
 * StatusCodes
 * 
 * @final
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
final class StatusCodes 
{
    const CODE_CONTINUE = 100;
    const CODE_SWITCHING_PROTOCOLS = 101;
    const CODE_PROCESSING = 102;
    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_ACCEPTED = 202;
    const CODE_NON_AUTHORITATIVE_INFORMATION = 203;
    const CODE_NO_CONTENT = 204;
    const CODE_RESET_CONTENT = 205;
    const CODE_PARTIAL_CONTENT = 206;
    const CODE_MULTI_STATUS = 207;
    const CODE_ALREADY_REPORTED = 208;
    const CODE_IM_USED = 226;
    const CODE_MULTIPLE_CHOICES = 300;
    const CODE_MOVED_PERMANENTLY = 301;
    const CODE_FOUND = 302;
    const CODE_SEE_OTHER = 303;
    const CODE_NOT_MODIFIED = 304;
    const CODE_USE_PROXY = 305;
    const CODE_RESERVED = 306;
    const CODE_TEMPORARY_REDIRECT = 307;
    const CODE_PERMANENTLY_REDIRECT = 308;
    const CODE_BAD_REQUEST = 400;
    const CODE_UNAUTHORIZED = 401;
    const CODE_PAYMENT_REQUIRED = 402;
    const CODE_FORBIDDEN = 403;
    const CODE_NOT_FOUND = 404;
    const CODE_METHOD_NOT_ALLOWED = 405;
    const CODE_NOT_ACCEPTABLE = 406;
    const CODE_PROXY_AUTHENTICATION_REQUIRED = 407;
    const CODE_REQUEST_TIMEOUT = 408;
    const CODE_CONFLICT = 409;
    const CODE_GONE = 410;
    const CODE_LENGTH_REQUIRED = 411;
    const CODE_PRECONDITION_FAILED = 412;
    const CODE_REQUEST_ENTITY_TOO_LARGE = 413;
    const CODE_REQUEST_URI_TOO_LONG = 414;
    const CODE_UNSUPPORTED_MEDIA_TYPE = 415;
    const CODE_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const CODE_EXPECTATION_FAILED = 417;
    const CODE_I_AM_A_TEAPOT = 418;
    const CODE_UNPROCESSABLE_ENTITY = 422;
    const CODE_LOCKED = 423;
    const CODE_FAILED_DEPENDENCY = 424;
    const CODE_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;
    const CODE_UPGRADE_REQUIRED = 426;
    const CODE_PRECONDITION_REQUIRED = 428;
    const CODE_TOO_MANY_REQUESTS = 429;
    const CODE_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    const CODE_INTERNAL_SERVER_ERROR = 500;
    const CODE_NOT_IMPLEMENTED = 501;
    const CODE_BAD_GATEWAY = 502;
    const CODE_SERVICE_UNAVAILABLE = 503;
    const CODE_GATEWAY_TIMEOUT = 504;
    const CODE_VERSION_NOT_SUPPORTED = 505;
    const CODE_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;
    const CODE_INSUFFICIENT_STORAGE = 507;
    const CODE_LOOP_DETECTED = 508;
    const CODE_NOT_EXTENDED = 510;
    const CODE_NETWORK_AUTHENTICATION_REQUIRED = 511;

	static public $messages = array(
    	self::CODE_CONTINUE => 'Continue',
    	self::CODE_SWITCHING_PROTOCOLS => 'Switching Protocols',
    	self::CODE_PROCESSING => 'Processing',
    	self::CODE_OK => 'Ok',
    	self::CODE_CREATED => 'Created',
    	self::CODE_ACCEPTED => 'Accepted',
    	self::CODE_NON_AUTHORITATIVE_INFORMATION => 'Non Authoritative Information',
    	self::CODE_NO_CONTENT => 'No Content',
    	self::CODE_RESET_CONTENT => 'Reset Content',
    	self::CODE_PARTIAL_CONTENT => 'Partial Content',
    	self::CODE_MULTI_STATUS => 'Multi Status',
    	self::CODE_ALREADY_REPORTED => 'Already Reported',
    	self::CODE_IM_USED => 'Im Used',
    	self::CODE_MULTIPLE_CHOICES => 'Multiple Choices',
    	self::CODE_MOVED_PERMANENTLY => 'Moved Permanently',
    	self::CODE_FOUND => 'Found',
    	self::CODE_SEE_OTHER => 'See Other',
    	self::CODE_NOT_MODIFIED => 'Not Modified',
    	self::CODE_USE_PROXY => 'Use Proxy',
    	self::CODE_RESERVED => 'Reserved',
    	self::CODE_TEMPORARY_REDIRECT => 'Temporary Redirect',
    	self::CODE_PERMANENTLY_REDIRECT => 'Permanently Redirect',
    	self::CODE_BAD_REQUEST => 'Bad Request',
    	self::CODE_UNAUTHORIZED => 'Unauthorized',
    	self::CODE_PAYMENT_REQUIRED => 'Payment Required',
    	self::CODE_FORBIDDEN => 'Forbidden',
    	self::CODE_NOT_FOUND => 'Not Found',
    	self::CODE_METHOD_NOT_ALLOWED => 'Method Not Allowed',
    	self::CODE_NOT_ACCEPTABLE => 'Not Acceptable',
    	self::CODE_PROXY_AUTHENTICATION_REQUIRED => 'Proxy Authentication Required',
    	self::CODE_REQUEST_TIMEOUT => 'Request Timeout',
    	self::CODE_CONFLICT => 'Conflict',
    	self::CODE_GONE => 'Gone',
    	self::CODE_LENGTH_REQUIRED => 'Length Required',
    	self::CODE_PRECONDITION_FAILED => 'Precondition Failed',
    	self::CODE_REQUEST_ENTITY_TOO_LARGE => 'Request Entity Too Large',
    	self::CODE_REQUEST_URI_TOO_LONG => 'Request Uri Too Long',
    	self::CODE_UNSUPPORTED_MEDIA_TYPE => 'Unsupported Media Type',
    	self::CODE_REQUESTED_RANGE_NOT_SATISFIABLE => 'Requested Range Not Satisfiable',
    	self::CODE_EXPECTATION_FAILED => 'Expectation Failed',
    	self::CODE_I_AM_A_TEAPOT => 'I Am A Teapot',
    	self::CODE_UNPROCESSABLE_ENTITY => 'Unprocessable Entity',
    	self::CODE_LOCKED => 'Locked',
    	self::CODE_FAILED_DEPENDENCY => 'Failed Dependency',
    	self::CODE_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL => 'Reserved For Webdav Advanced Collections Expired_proposal',
    	self::CODE_UPGRADE_REQUIRED => 'Upgrade Required',
    	self::CODE_PRECONDITION_REQUIRED => 'Precondition Required',
    	self::CODE_TOO_MANY_REQUESTS => 'Too Many Requests',
    	self::CODE_REQUEST_HEADER_FIELDS_TOO_LARGE => 'Request Header Fields Too Large',
    	self::CODE_INTERNAL_SERVER_ERROR => 'Internal Server Error',
    	self::CODE_NOT_IMPLEMENTED => 'Not Implemented',
    	self::CODE_BAD_GATEWAY => 'Bad Gateway',
    	self::CODE_SERVICE_UNAVAILABLE => 'Service Unavailable',
    	self::CODE_GATEWAY_TIMEOUT => 'Gateway Timeout',
    	self::CODE_VERSION_NOT_SUPPORTED => 'Version Not Supported',
    	self::CODE_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL => 'Variant Also Negotiates Experimental',
    	self::CODE_INSUFFICIENT_STORAGE => 'Insufficient Storage',
    	self::CODE_LOOP_DETECTED => 'Loop Detected',
    	self::CODE_NOT_EXTENDED => 'Not Extended',
    	self::CODE_NETWORK_AUTHENTICATION_REQUIRED => 'Network Authentication Required',
	);

	/**
	 * getMessage 
	 * 
	 * @param mixed $code 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getMessage($code)
	{
		if(!isset($this->messages[$code])) {
			throw new InvalidArgumentException(sprintf('Message for Code "%s" is not defined.', $code));
		}
		return $this->messages[$code];
	}

	static public function validateCode($code)
	{
		return array_key_exists($code, self::messages);
	}

	static public function roundCode($code)
	{
		return ((int)($code / 100)) * 100;
	}
}

