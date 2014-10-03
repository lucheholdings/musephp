<?php
namespace Terpsichore\Core\Service;

use Terpsichore\Core\Service;

/**
 * ServiceProvider 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ServiceProvider
{
	/**
	 * hasService 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function hasService($name);

	/**
	 * getService 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	function getService($name);

	/**
	 * setService 
	 * 
	 * @param mixed $name 
	 * @param Service $service 
	 * @access public
	 * @return void
	 */
	function setService($name, Service $service);
}

