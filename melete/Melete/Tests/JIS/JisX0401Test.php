<?php
namespace Melete\Tests\JIS;

use Symfony\Component\Config\FileLocator;
use Melete\Loader\CsvFileLoader;
use Melete\JIS\JisX0401;

class JisX0401Test extends \PHPUnit_Framework_TestCase 
{
	public function testLoad()
	{
		$standard = JisX0401::createDefault();
		
		$this->assertInstanceof('Melete\JIS\JisX0401', $standard);

		//
		$this->assertCount(47, $standard->getContents());

		$this->assertEquals('北海道', $standard->getByCode('1')->name);
		$this->assertEquals(1, $standard->getByCode('1')->code);
		$this->assertEquals('沖縄県', $standard->getByCode('47')->name);
	}
}

