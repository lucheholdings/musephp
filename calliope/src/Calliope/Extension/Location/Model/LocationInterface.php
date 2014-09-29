<?php
namespace Calliope\Extension\Location\Model;

/**
 * Class 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface LocationInterface
{
	/**
	 * getHash 
	 * 
	 * @access public
	 * @return void
	 */
	function getHash();

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();
}

