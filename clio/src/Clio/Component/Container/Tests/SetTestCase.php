<?php
namespace Clio\Component\Container\Tests;

abstract class SetTestCase extends \PHPUnit_Framework_TestCase
{
    function testBasic()
    {
        $set = $this->createContainer(array('foo'));

        $this->assertContains('foo', $set->getRaw());
        $this->assertCount(1, $set);

        $set->add('bar');
        $this->assertContains('bar', $set->getRaw());
        $this->assertCount(2, $set);

        $set->remove('bar');
        $this->assertNotContains('bar', $set->getRaw());
        $this->assertCount(1, $set);
    }

    abstract protected function createContainer($defaults = null);
}

