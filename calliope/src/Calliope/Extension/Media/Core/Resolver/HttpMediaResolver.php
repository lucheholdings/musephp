<?php
namespace Calliope\Extension\Media\CoreResolver;

use Calliope\Extension\Media\CoreMedia\HttpMediaInterface;
use Calliope\Extension\Media\CoreModel\ContentInterface;

/**
 * HttpMediaResovler 
 *   MediaResovler to resolve media contnet URL
 * 
 * @uses MediaResolver
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpMediaResolver extends MediaResolver
{
	/**
	 * resolveUrl 
	 * 
	 * @param ContentInterface $content 
	 * @access public
	 * @return void
	 */
	public function resolveUrl(ContentInterface $content)
	{
		// Resolve Media for the content
		$media = $this->resolveMedia($content);

		if(!$media instanceof HttpMediaInterface) {
			throw new \RuntimeException(sprintf('Media "%s" is not an instanceof HttpMediaInterface thus cannot resolve URL for the content.', $type));
		}

		// convert content to array
		return $media->generateContentPath($content);
	}
}

