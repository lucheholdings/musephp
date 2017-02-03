<?php
namespace Clio\Component\Tool\Serializer\Tests\Strategy;

use Clio\Component\Tool\Serializer\Strategy\JsonSerializableStrategy;
use Clio\Component\Tool\Serializer\Tests\TestModel;

/**
 * JsonSerializableStrategyTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class JsonSerializableStrategyTest extends \PHPUnit_Framework_TestCase 
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
		$json = $strategy->serialize($model, 'json');
		$this->assertJson($json);

		$this->assertJsonStringEqualsJsonString(json_encode(array('foo' => 'foo', 'bar' => 'bar')), $json);
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
			$this->strategy = new JsonSerializableStrategy(); 
		}
		return $this->strategy;
	}
	protected function getSerializeObject()
	{
		return new TestModel('foo', 'bar');
	}
}


