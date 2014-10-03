<?php
namespace Terpsichore\Core\Request;

use Terpsichore\Core\Request;

/**
 * ProxyRequest 
 * 
 * @uses Request
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ProxyRequest extends Request
{
	/**
	 * getRequest 
	 * 
	 * @access public
	 * @return void
	 */
	function getRequest();
}

