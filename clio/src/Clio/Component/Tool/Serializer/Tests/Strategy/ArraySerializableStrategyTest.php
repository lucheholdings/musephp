<?php
namespace Clio\Component\Tool\Serializer\Tests\Strategy;

use Clio\Component\Tool\Serializer\Strategy\ArraySerializableStrategy;
use Clio\Component\Tool\Serializer\Tests\TestModel;

/**
 * ArraySerializableStrategyTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArraySerializableStrategyTest extends \PHPUnit_Framework_TestCase 
{
	/**
	 * testSerialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSerialize()
	{
		$strategy = $this->getStrategy();

		$model = $this->getSerializeObject();
		$array = $strategy->serialize($model, 'array');
		$this->assertInternalType('array', $array);

		$this->assertContains('foo', $array);
		$this->assertContains('bar', $array);
	}

	/**
	 * testInvalidSerializationFormat 
	 * 
	 * @access public
	 * @return void
	 * 
	 * @expectedException Clio\Component\Tool\Serializer\Exception\UnsupportedFormatException
	 */
	public function testInvalidSerializationFormat()
	{
		$model = $this->getSerializeObject();
		$this->getStrategy()->serialize($model, 'xml');
	}

	protected $strategy;

	protected function getStrategy()
	{
		if(!$this->strategy) {
			$this->strategy = new ArraySerializableStrategy(); 
		}
		return $this->strategy;
	}
	protected function getSerializeObject()
	{
		return new TestModel('foo', 'bar');
	}
}


