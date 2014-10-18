<?php
namespace Clio\Component\Util\Accessor\Tests;

abstract class AbstractAccessorTest extends \PHPUnit_Framework_TestCase 
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

		// value
		$this->assertFalse($accessor->isNull('foo'));
		$this->assertEquals('Foo', $accessor->get('foo'));
		$this->assertTrue($accessor->existsField('foo'));
		// null value
		$this->assertTrue($accessor->isNull('bar'));
		$this->assertEquals(null, $accessor->get('bar'));
		$this->assertTrue($accessor->existsField('bar'));
		// false value
		$this->assertFalse($accessor->isNull('hoge'));
		$this->assertEquals(false, $accessor->get('hoge'));
		$this->assertTrue($accessor->existsField('hoge'));

		// Contain 
		$this->assertFalse($accessor->existsField('var'));

		$this->assertEquals(array('foo', 'bar', 'hoge'), $accessor->getFieldNames());
	}

	/**
	 * getDefaultData 
	 * 
	 * @access protected
	 * @return void
	 */
	abstract protected function getDefaultData();

	/**
	 * createAccessor 
	 * 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	abstract protected function createAccessor($data = null);
}

