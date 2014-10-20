<?php
namespace Clio\Component\Util\Accessor\Tests;

abstract class SchemaAccessorTestCase extends \PHPUnit_Framework_TestCase 
{

	/**
	 * testValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function testValues()
	{
		$accessor = $this->createAccessor();
		$data = $this->getData();

		// value
		$this->assertFalse($accessor->isNull($data, 'foo'));
		$this->assertEquals('Foo', $accessor->get($data, 'foo'));
		$this->assertTrue($accessor->existsField($data, 'foo'));
		// null value
		$this->assertTrue($accessor->isNull($data, 'bar'));
		$this->assertEquals(null, $accessor->get($data, 'bar'));
		$this->assertTrue($accessor->existsField($data, 'bar'));
		// false value
		$this->assertFalse($accessor->isNull($data, 'hoge'));
		$this->assertEquals(false, $accessor->get($data, 'hoge'));
		$this->assertTrue($accessor->existsField($data, 'hoge'));

		// Contain 
		$this->assertFalse($accessor->existsField($data, 'var'));

		$this->assertEquals(array('foo', 'bar', 'hoge'), $accessor->getFieldNames($data));
	}

	/**
	 * getDefaultData 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getData()
	{
		return array('foo' => 'Foo', 'bar' => null, 'hoge' => false);		
	}

	/**
	 * createAccessor 
	 * 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	abstract protected function createAccessor();
}

