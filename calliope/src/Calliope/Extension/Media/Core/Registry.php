<?php
namespace Calliope\Extension\Media\Core;

use Calliope\Extension\Media\Core\Media;
use Calliope\Extension\Media\Core\Media\NamedMedia;

/**
 * Registry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Registry
{
	/**
	 * medias 
	 * 
	 * @var array
	 * @access private
	 */
	private $medias = array();

	/**
	 * hasMedia 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasMedia($name) 
	{
		return isset($this->medias[$name]);
	}

	/**
	 * getMedia 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getMedia($name)
	{
		if(!isset($this->medias[$name])) {
			throw new \RuntimeException(sprintf('Media "%s" is not registered.', $name));
		}
		return $this->medias[$name];
	}

	/**
	 * addMedia 
	 * 
	 * @param Media $media 
	 * @access public
	 * @return void
	 */
	public function addMedia(NamedMedia $media)
	{
		return $this->setMedia($media->getName(), $media);
	}

	/**
	 * setMedia 
	 * 
	 * @param mixed $name 
	 * @param Media $media 
	 * @access public
	 * @return void
	 */
	public function setMedia($name, Media $media) 
	{
		$this->medias[$name] = $media;
		return $this;
	}

	/**
	 * getMediaForMediaType
	 * 
	 * @param mixed $mediaType 
	 * @access public
	 * @return array
	 */
	public function getMediaForMediaType($mediaType)
	{
		$medias = array();
		foreach($this->medias as $media) {
			if($media->isSupportMediaType($mediaType)) {
				$medias[] = $media;
			}
		}

		return $medias;
	}
}

