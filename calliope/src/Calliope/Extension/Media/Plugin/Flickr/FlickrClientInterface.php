<?php
namespace Calliope\Extension\Media\Plugin\Flickr;

/**
 * FlickrPhotoProviderInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FlickrPhotoProviderInterface
{
	/**
	 * getPhotoInfo 
	 *   Call "flickr.photos.getInfo" API
	 * @param mixed $photoId 
	 * @access public
	 * @return void
	 */
	function getPhotoInfo($photoId);
}

