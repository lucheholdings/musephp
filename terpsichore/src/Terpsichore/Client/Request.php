<?php
namespace Terpsichore\Client;

/**
 * Request 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Request 
{
	/**
	 * getBody 
	 * 
	 * @access public
	 * @return void
	 */
	function getBody();

	/**
	 * setBody 
	 * 
	 * @param mixed $body 
	 * @access public
	 * @return void
	 */
	function setBody($body);

	/**
	 * getHeaders 
	 * 
	 * @access public
	 * @return void
	 */
	function getHeaders();

	/**
	 * setHeaders 
	 * 
	 * @param array $headers 
	 * @access public
	 * @return void
	 */
	function setHeaders(array $headers);

	/**
	 * setHeader 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function setHeader($name, $value);

	/**
	 * getHeader 
	 * 
	 * @param mixed $name 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	function getHeader($name, $default = null);

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

