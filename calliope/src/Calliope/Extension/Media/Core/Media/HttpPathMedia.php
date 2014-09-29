<?php
namespace Calliope\Extension\Media\Core\Media;

use Calliope\Extension\Media\Core\Model\ContentInterface;
/**
 * PathTypeMedia 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpPathMedia extends AbstractMedia implements HttpMedia
{
	/**
	 * generateUrl 
	 * 
	 * @param array $params 
	 * @access public
	 * @return void
	 */
	public function generateUrl(array $params = array())
	{
		if(!isset($params['path']))
			return null;
		return $params['path'];
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
		return $this->generateUrl($content->getMediaParameters());
	}

	/**
	 * validateMediaContent 
	 * 
	 * @param ContentInterface $content 
	 * @access public
	 * @return void
	 */
	public function validateMediaContent(ContentInterface $content)
	{
		parent::validateMediaContent($content);

		$params = $content->getMediaParameters();

		if(!isset($params['path'])) {
			throw new \Exception('PathMedia requires parameter "path" on content.');
		}
	}
}

