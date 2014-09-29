<?php
namespace Calliope\Extension\Media\Core\Model;

/**
 * ContentInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ContentInterface
{
	/**
	 * getType 
	 *   Media Type 
	 * @access public
	 * @return void
	 */
	function getType();

	/**
	 * getUrl 
	 *   Media Url will be setted by Media 
	 * @access public
	 * @return void
	 */
	function getUrl();

	/**
	 * getMediaParameters 
	 * 
	 * @access public
	 * @return void
	 */
	function getMediaParameters();
}

