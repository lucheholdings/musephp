<?php
namespace Calliope\Framework\Core\Model;

/**
 * TimeStampable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface TimeStampable
{
	/**
	 * getCreatedAt 
	 * 
	 * @access public
	 * @return void
	 */
	function getCreatedAt();

	/**
	 * getUpdatedAt 
	 * 
	 * @access public
	 * @return void
	 */
	function getUpdatedAt();
}

