<?php
namespace Clio\Component\Format\Tests;

/**
 * ParserTestCase 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ParserTestCase extends \PHPUnit_Framework_TestCase
{
	/**
	 * testParse 
	 * 
	 * @access public
	 * @return void
	 */
	public function testParse()
	{
		$parser = $this->getParser();
		$content = $this->convertToFormattedData(array(
			'foo' => array('upper' => 'FOO', 'lower' => 'foo'),
			'bar' => 'Bar',
		));

		$parsed = $parser->parse($content);

		$this->assertCount(2, $parsed);
		$this->assertContains('Bar', $parsed);

		$this->assertCount(2, $parsed['foo']);
	}

	abstract protected function convertToFormattedData(array $data);

	abstract protected function getParser();
}

