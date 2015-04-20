<?php
namespace Calliope\Core\Tests\Schema\Registry;

use Calliope\Core\Schema\Registry\ValidateRegistry;

use Clio\Component\Pattern\Registry\MapRegistry;
use Calliope\Core\Tests\TestSchema;

/**
 * ValidateRegistryTest 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ValidateRegistryTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $registry = new ValidateRegistry(new MapRegistry(array('hoge' => 'hoge')));

        $schema = new TestSchema();
        $registry->set('foo', $schema);

        try {
            $registry->set('bar', 'bar');
            $this->fail('Expect thrown Exception.');
        } catch(\RuntimeException $ex) {
            $this->assertTrue(true);
        }

        $this->assertEquals($schema, $registry->get('foo'));

        $this->assertFalse($registry->has('bar'));

        try {
            $registry->get('hoge');
            $this->fail('Expect thrown Exception.');
        } catch(\RuntimeException $ex) {
            $this->assertTrue(true);
        }
    }
}


