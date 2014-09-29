<?php
namespace Calliope\Extension\Media\Core\Media;

use Calliope\Extension\Media\Core\Media;
use Calliope\Extension\Media\Core\Model\ContentInterface;

/**
 * HttpMediaInterface 
 * 
 * @uses MediaInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface HttpMedia extends Media
{

	/**
	 * generateUrl 
	 * 
	 * @access public
	 * @return void
	 */
	function generateUrl();

	/**
	 * generateContentUrl 
	 * 
	 * @param ContentInterface $content 
	 * @access public
	 * @return void
	 */
	function generateContentUrl(ContentInterface $content);
}

