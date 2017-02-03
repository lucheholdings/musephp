<?php
namespace Clio\Component\Web\Exception;

use Clio\Component\Exception\RuntimeException;
use Clio\Component\Web\StatusCodes;


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
class NotFoundException extends RuntimeException implements Throwable 
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

