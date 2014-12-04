<?php
namespace Calliope\Core;

use Calliope\Core\Manager;
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
	 * getConnectFrom 
	 * 
	 * @access public
	 * @return Manager 
	 */
	function getConnectFrom();

	/**
	 * connect 
	 * 
	 * @access public
	 * @return void
	 */
	function connect(Manager $from);

	/**
	 * disconnect 
	 * 
	 * @access public
	 * @return void
	 */
	function disconnect();
}

