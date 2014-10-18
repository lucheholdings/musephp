<?php
namespace Clio\Component\Exception;

/**
 * Exception 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Exception extends \Exception implements Throwable 
{
	const DEFAULT_MESSAGE = 'Exception';

	/**
	 * __construct 
	 * 
	 * @param string $message 
	 * @param int $code 
	 * @param \Exception $previous 
	 * @access public
	 * @return void
	 */
	public function __construct($message = '', $code = 0, \Exception $previous = NULL) 
	{
		if(empty($message)) {
			$message = static::DEFAULT_MESSAGE;
		}
		parent::__construct($message, $code, $previous);
	}
	
}

