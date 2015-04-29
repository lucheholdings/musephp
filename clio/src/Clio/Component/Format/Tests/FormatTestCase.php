<?php
namespace Clio\Component\Format\Tests;
use Clio\Component\Format\Format;

abstract class FormatTestCase extends \PHPUnit_Framework_TestCase
{
	private $format;

	public function getFormat()
	{
		return $this->format;
	}

	public function setFormat(Format $format)
	{
		$this->format = $format;
	}
}

