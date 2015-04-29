<?php
namespace Clio\Component\Format\Tests\Json;

use Clio\Component\Format\Tests\FormatTestCase;
use Clio\Component\Format\Json\Json;

class JsonTest extends FormatTestCase 
{
	public function setUp()
	{
		$this->setFormat(new Json());
	}

	public function testDefaults()
	{
		$format = $this->getFormat();
		$this->assertInstanceOf('Clio\Component\Format\Json\Parser', $format->getParser());
		$this->assertInstanceOf('Clio\Component\Format\Json\Dumper', $format->getDumper());

		$this->assertEquals('json', $format->getName());
		$this->assertEquals('json', $format->getFileExtension());
		$this->assertEquals('application/json', $format->getContentType());
	}
}

