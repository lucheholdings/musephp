<?php
namespace Terpsichore\Client;

use Terpsichore\Core\Request as BaseRequest;

/**
 * Request 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Request extends BaseRequest
{
	/**
	 * isDirty 
	 * 
	 * @access public
	 * @return void
	 */
	function isDirty();

	/**
	 * clean 
	 * 
	 * @access public
	 * @return void
	 */
	function clean();
}

