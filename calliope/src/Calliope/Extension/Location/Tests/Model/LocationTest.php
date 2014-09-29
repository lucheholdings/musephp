<?php
namespace Calliope\Extension\Location\Tests\Model;

use Clio\Component\Tag\Model\Tag;
use Calliope\Extension\Location\Model\Location;
use Calliope\Extension\Location\LocationTags;

/**
 * LocationTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LocationTest extends \PHPUnit_Framework_TestCase
{
	public function testGetTypes()
	{
		$location = new Location();

		$location->getTags()
			->add(new Tag(LocationTags::nameTypeTag('city')))
			->add(new Tag('foo'))
		;

		$types = $location->getTypes();

		$this->assertCount(1, $types);
		$this->assertContains(LocationTags::nameTypeTag('city'), $types);
	}
}

