<?php
namespace Clio\Component\Type\Tests;

use Clio\Component\Type\PrimitiveTypes;
use Clio\Component\Type\Registry as TypeRegistry;

class BasicRegistryTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * testBasic 
     * 
     * @access public
     * @return void
     */
    public function testBasic()
    {
        $registry = TypeRegistry\Factory::createDefault();

        $this->assertTrue($registry->hasType('int'));
        $this->assertTrue($registry->hasType('string'));
        $this->assertFalse($registry->hasType('hoge'));

        $type = $registry->getType('int');

        $this->assertEquals(PrimitiveTypes::TYPE_INT, $type->getName());
        $this->assertInstanceof('Clio\Component\Type\Actual\ScalarType', $type);
    }
}

