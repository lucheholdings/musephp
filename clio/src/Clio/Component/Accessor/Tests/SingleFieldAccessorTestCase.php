<?php
namespace Clio\Component\Accessor\Tests;

use Clio\Component\Accessor\Accessor;

/**
 * FieldAccessorTestCase 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class SingleFieldAccessorTestCase extends \PHPUnit_Framework_TestCase 
{
    /**
     * testBasic 
     * 
     * @access public
     * @return void
     */
    public function testBasic()
    {
        $accessor = $this->createAccessor();
        $data = $this->createData();

        // Start Test
        $accessor->set($data, 'foo');
        $this->assertEquals('foo', $this->getFieldValue($data));
        $this->assertEquals('foo', $accessor->get($data));

        $accessor->set($data, 'bar');
        $this->assertEquals('bar', $this->getFieldValue($data));
        $this->assertEquals('bar', $accessor->get($data));
        $this->assertFalse($accessor->isNull($data));

        $accessor->clear($data);
        $this->assertNull($this->getFieldValue($data));
        $this->assertTrue($accessor->isNull($data));

        $this->assertEquals($this->getFieldName(), $accessor->getFieldName());

        $this->assertTrue($accessor->isSupportedAccess($data, Accessor::ACCESS_TYPE_GET));
        $this->assertTrue($accessor->isSupportedAccess($data, Accessor::ACCESS_TYPE_SET));
        try {
            $accessor->isSupportedAccess($data, 'hoge');
        } catch(\InvalidArgumentException $ex) {
            $this->assertTrue(true);
        }
    }

    abstract protected function createAccessor();

    abstract protected function createData();

    abstract protected function getFieldName(); 

    abstract protected function getFieldValue($data);
}

