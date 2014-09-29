<?php
namespace Calliope\Extension\Media\Plugin\Flickr\Media;

use Calliope\Extension\Media\Core\Media\HttpPatternPath;

/**
 * Photo
 *  Flickr Photo Media 
 * 
 * @uses HttpMediaInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Photo extends HttpPatternPath
{
	const URL_PATTERN = 'http://farm{farm}.staticflickr.com/{server}/{photo_id}_{secret}_{size}.{format}';

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(FlickrClientInterface $client)
	{
		parent::__construct(self::URL_PATTERN);
		$this->client = $client;
	}

	/**
	 * generateUrl 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function generateUrl(array $options = array())
	{
		$info = $this->getPhotoInfo($options['photo_id']);

		// clean the options
		if(isset($options['size'])) {
			switch($options['size']) {
				case 'original':
				case 'o':
					$info['size'] = 'o'; 
					break;
				default:
					break;
			}
			
			// if not original, then use jpg format
			// or if format is not specified. 
			if('o' !== $info['size']) {
				$info['format'] = 'jpg';
			} else if(!isset($info['format'])) {
				$info['format'] = 'jpg';
			}
		}

		return parent::generateUrl($info);
	}

	/**
	 * getPhotoInfo 
	 * 
	 * @param mixed $photoId 
	 * @access public
	 * @return void
	 */
	public function getPhotoInfo($photoId)
	{
		$info = array();

		// 
		$photo = $this->getClient()->getPhotoInfo($photoId);

		return $info;
	}

	/**
	 * generateContentUrl 
	 * 
	 * @param ContentInterface $content 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function generateContentUrl(ContentInterface $content, array $options = array())
	{
		// Get path as photo_id from the content
		return $this->generateUrl(array_merge($options, array('photo_id' => $content->getPath()));
	}

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	public function getName()
	{
		return 'flickr.photo';
	}
}

