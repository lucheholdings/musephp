<?php
namespace Melete\Tests\JIS;

use Symfony\Component\Config\FileLocator;
use Melete\Loader\CsvFileLoader;
use Melete\JIS\JisX0402;

class JisX0402Test extends \PHPUnit_Framework_TestCase 
{
	public function testLoad()
	{
		$standard = JisX0402::createDefault();
		
		$this->assertInstanceof('Melete\JIS\JisX0402', $standard);

		//
		$this->assertCount(1947, $standard->getContents());

		$this->assertEquals('札幌市中央区', $standard->getByCode('01101')->name);
	}
}

