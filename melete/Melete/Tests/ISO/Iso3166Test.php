<?php
namespace Melete\Tests\ISO;

use Symfony\Component\Config\FileLocator;
use Melete\Loader\CsvFileLoader;
use Melete\ISO\Iso3166;

class Iso3166Test extends \PHPUnit_Framework_TestCase 
{
	public function testLoad()
	{
		$standard = Iso3166::createDefault();
		
		$this->assertInstanceof('Melete\ISO\Iso3166', $standard);

		//
		$this->assertCount(249, $standard->getContents());

		$this->assertArrayHasKey('JP', $standard->getContentsByAlpha2());
		$this->assertEquals('Japan', $standard->getByAlpha2('JP')->name);
		$this->assertEquals('Japan', $standard->getByAlpha3('JPN')->name);
	}
}


