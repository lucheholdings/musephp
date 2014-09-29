<?php
namespace Calliope\Extension\Location\Tests\Builder;

use Calliope\Extension\Location\Builder\LocationBuilder;
use Calliope\Extension\Location\LocationTags;

/**
 * LocationBuilderTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LocationBuilderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testBuild 
	 * 
	 * @access public
	 * @return void
	 */
	public function testBuild()
	{
		$builder = LocationBuilder::create();
		
		$builder
			->setName('sapporo')
		;

		$location = $builder->build();

		$this->assertInstanceOf('Calliope\Extension\Location\Model\Location', $location);

		$this->assertEquals('sapporo', $location->getName());
	}
}

