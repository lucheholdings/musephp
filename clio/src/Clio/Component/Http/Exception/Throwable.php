<?php
namespace Clio\Component\Http\Exception;

use Clio\Component\Exception\Throwable as BaseThrowable;

/**
 * Throwable 
 * 
 * @uses BaseThrowable
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Throwable extends BaseThrowable
{
	/**
	 * getHttpStatusCode 
	 * 
	 * @access public
	 * @return void
	 */
	function getHttpStatusCode();
}

