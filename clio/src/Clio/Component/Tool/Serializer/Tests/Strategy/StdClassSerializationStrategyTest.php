<?php
namespace Clio\Component\Tool\Serializer\Tests\Strategy;

use Clio\Component\Tool\Serializer\Strategy\StdClassSerializationStrategy;
use Clio\Component\Tool\Serializer\Tests\TestModel;

use Clio\Component\Tool\Serializer\Tool\ArrayParser;
use Clio\Component\IO\Format\Json\Parser as JsonParser,
	Clio\Component\IO\Format\Json\Dumper as JsonDumper
;

/**
 * ArraySerializableStrategyTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StdClassSerializationStrategyTest extends \PHPUnit_Framework_TestCase 
{
	/**
	 * testSerialize 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSerializeJson()
	{
		$strategy = $this->getStrategy();

		$model = $this->getSerializeObject();
		$json = $strategy->serialize($model, 'json');
		$this->assertJson($json);
		$this->assertJsonStringEqualsJsonString(json_encode(array('foo' => 'foo', 'bar' => 'bar')), $json);
	}

	public function testDeserialize()
	{
		$strategy = $this->getStrategy();

		$model = $strategy->deserialize(json_encode(array('foo' => 'foo', 'bar' => 'bar')), 'StdClass', 'json');

		$this->assertInstanceOf('StdClass', $model);
		$this->assertEquals('foo', $model->foo);
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
			$this->strategy = new StdClassSerializationStrategy(
				new ArrayParser(array(
					'json' => array(new JsonParser(), new JsonDumper()),
				))
			); 
		}
		return $this->strategy;
	}
	protected function getSerializeObject()
	{
		$model = new \StdClass();
		$model->foo = 'foo';
		$model->bar = 'bar';

		return $model;
	}
}


