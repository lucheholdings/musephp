<?php
namespace Terpsichore\Client;

/**
 * Connection 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Connection
{
	/**
	 * send 
	 * 
	 * @param Request $request 
	 * @access public
	 * @return void
	 */
	function send(Request $request);

	/**
	 * isSecured 
	 * 
	 * @access public
	 * @return void
	 */
	function isSecured();

	/**
	 * getSecuredConnection 
	 * 
	 * @access public
	 * @return void
	 * @throw NotSecuredException
	 */
	function getSecuredConnection();
}

