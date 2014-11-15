<?php
namespace Clio\Component\Http\Exception;

use Clio\Component\Exception\RuntimeException;
use Clio\Component\Http\StatusCodes;


/**
 * NotFoundException 
 * 
 * @uses RuntimeException
 * @uses Throwable
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NotFoundException extends HttpException implements Throwable 
{
	/**
	 * getHttpStatusCode 
	 * 
	 * @access public
	 * @return void
	 */
	public function getHttpStatusCode()
	{
		return StatusCodes::CODE_NOT_FOUND;
	}
}

