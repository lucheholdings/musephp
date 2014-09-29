<?php
namespace Calliope\Extension\Media\CoreTests\Resolver;

use Calliope\Extension\Media\CoreMediaRegistry,
	Calliope\Extension\Media\CoreResolver\HttpMediaResolver,
	Calliope\Extension\Media\CoreModel\Content,
	Calliope\Extension\Media\CoreMedia\HttpFileMedia
;
use Clio\Component\Locator\FileLocator;

class HttpMediaResolverTest extends ResolverTestCase
{
	public function setUp()
	{
		$this->mediaRegistry = new MediaRegistry();
		$this->mediaRegistry
			->addMedia(new HttpFileMedia(new FileLocator(__DIR__ . '/../Fixtures'), '/assets/images'))
		;
	}

	public function testResolveUrl()
	{
		$resolver = $this->createResolver();

		$content = new Content();
		$content
			->setType('file')
			->setPath('test.jpg')
		;

		$url = $resolver->resolveUrl($content);

		$this->assertEquals('/assets/images/test.jpg', $url);
	}

	protected function createResolver()
	{
		return new HttpMediaResolver($this->getMediaRegistry());
	}
}

