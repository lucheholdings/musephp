<?php
namespace Clio\Component\IO\Format\Tests\Json;

use Clio\Component\IO\Format\Tests\ParserTestCase;
use Clio\Component\IO\Format\Json\Parser;

class ParserTest extends ParserTestCase
{
	protected function convertToFormattedData(array $data)
	{
		return json_encode($data);
	}

	protected function getParser()
	{
		return new Parser();
	}
}

