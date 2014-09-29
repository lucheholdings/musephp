<?php
namespace Calliope\Extension\Media\CoreTests\Media;

/**
 * MediaTestCase 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class MediaTestCase extends \PHPUnit_Framework_TestCase 
{
	/**
	 * assertMediaInstance 
	 * 
	 * @param mixed $instance 
	 * @access protected
	 * @return void
	 */
	protected function assertMediaInstance($instance)
	{
		$this->assertInstanceOf('Calliope\Extension\Media\CoreMedia\MediaInterface', $instance);
	}

	/**
	 * assertHttpMediaInstance 
	 * 
	 * @param mixed $instance 
	 * @access protected
	 * @return void
	 */
	protected function assertHttpMediaInstance($instance)
	{
		$this->assertMediaInstance($instance);
		$this->assertInstanceOf('Calliope\Extension\Media\CoreMedia\HttpMediaInterface', $instance);
	}
}

