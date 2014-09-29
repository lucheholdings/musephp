<?php
namespace Calliope\Extension\Media\CoreTests\Resolver;

use Calliope\Extension\Media\CoreMedia\FileMedia,
	Calliope\Extension\Media\CoreMediaRegistry,
	Calliope\Extension\Media\CoreResolver\MediaResolver,
	Calliope\Extension\Media\CoreModel\Content
;
use Clio\Component\Locator\FileLocator;

/**
 * MediaResolverTest 
 * 
 * @uses ResolverTestCase
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MediaResolverTest extends ResolverTestCase
{

	public function setUp()
	{
		$this->mediaRegistry = new MediaRegistry();
		$this->mediaRegistry
			->addMedia(new FileMedia(new FileLocator(__DIR__ . '/../Fixtures')))
		;
	}

	public function testResolve()
	{
		$resolver = $this->createResolver();

		$content = new Content();
		$content
			->setType('file')
			->setPath('test.jpg')
		;

		$media = $resolver->resolveMedia($content);

		// Assert the instance 
		$this->assertInstanceofMedia($media);
		$this->assertInstanceof('Calliope\Extension\Media\CoreMedia\FileMedia', $media);

	}

	protected function createResolver()
	{
		return new MediaResolver($this->getMediaRegistry());
	}
}

