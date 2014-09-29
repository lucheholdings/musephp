<?php
namespace Calliope\Extension\Media\CoreTests;

use Calliope\Extension\Media\CoreMediaRegistry;
use Calliope\Extension\Media\CoreMedia\HttpFileMedia;
use Clio\Component\Locator\FileLocator;

/**
 * MediaRegistryTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MediaRegistryTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testSuccess 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSuccess()
	{
		$registry = new MediaRegistry();
		$registry->addMedia(new HttpFileMedia(new FileLocator(__DIR__)));

		$this->assertInstanceOf('Calliope\Extension\Media\CoreMedia\HttpFileMedia', $registry->getMedia('file'));
	}

	/**
	 * testSuccess 
	 * 
	 * @access public
	 * @return void
	 * 
	 * @expectedException \RuntimeException
	 */
	public function testNotRegistered()
	{
		$registry = new MediaRegistry();
		$registry->addMedia(new HttpFileMedia(new FileLocator(__DIR__)));

		$registry->getMedia('pattern');
	}
}

