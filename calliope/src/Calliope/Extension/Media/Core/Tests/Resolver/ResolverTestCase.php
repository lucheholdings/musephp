<?php
namespace Calliope\Extension\Media\CoreTests\Resolver;

use Calliope\Extension\Media\CoreMediaRegistry;

abstract class ResolverTestCase extends \PHPUnit_Framework_TestCase
{
	protected $mediaRegistry;

	protected function assertInstanceofMedia($instance)
	{
		$this->assertInstanceof('Calliope\Extension\Media\CoreMedia\MediaInterface', $instance);
	}

	protected function assertInstanceofHttpMedia($instance)
	{
		$this->assertInstanceof('Calliope\Extension\Media\CoreMedia\HttpMediaInterface', $instance);
	}

	protected function setMediaRegistry(MediaRegistry $registry)
	{
		$this->mediaRegistry = $registry;
	}

	protected function getMediaRegistry()
	{
		return $this->mediaRegistry;
	}
}

