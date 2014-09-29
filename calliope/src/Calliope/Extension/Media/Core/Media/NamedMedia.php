<?php
namespace Calliope\Extension\Media\Core\Media;

use Calliope\Extension\Media\Core\Media;

/**
 * NamedMedia 
 * 
 * @uses Media
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface NamedMedia extends Media 
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();
}

