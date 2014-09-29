<?php
namespace Calliope\Extension\Media\CoreTests\Media;

use Calliope\Extension\Media\CoreMedia\HttpFileMedia;
use Calliope\Extension\Media\CoreModel\Content;
use Clio\Component\Locator\FileLocator;

/**
 * HttpFileMediaTest 
 * 
 * @uses MediaTestCase
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HttpFileMediaTest extends MediaTestCase 
{
	public function testCreate()
	{
		$media = $this->createMedia();

		// Check the media instance
		$this->assertHttpMediaInstance($media);
	}

	/**
	 * testGenerateUrl 
	 * 
	 * @access public
	 * @return void
	 */
	public function testGenerateUrl()
	{
		$media = $this->createMedia();
		$url = $media->generatePath(array('filepath' => 'test.jpg'));

		// assert the generated url
		$this->assertEquals('/assets/images/test.jpg', $url);
	}

	/**
	 * testGenerateContentUrl 
	 * 
	 * @access public
	 * @return void
	 */
	public function testGenerateContentUrl()
	{
		$media = $this->createMedia();

		$content = new Content();
		$content->setPath('test.jpg');

		$url = $media->generateContentPath($content);

		// assert the generated url
		$this->assertEquals('/assets/images/test.jpg', $url);
	}

	/**
	 * createMedia 
	 * 
	 * @access public
	 * @return void
	 */
	public function createMedia()
	{
		return new HttpFileMedia(new FileLocator(__DIR__ . '/../Fixtures'), '/assets/images');
	}
}

