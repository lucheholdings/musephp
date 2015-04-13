<?php
namespace Clio\Component\Util\Type\Tests;

use Clio\Component\Util\Type\PrimitiveTypes;
use Clio\Component\Util\Type\Registry as TypeRegistry;

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
        $this->assertInstanceof('Clio\Component\Util\Type\Actual\ScalarType', $type);
    }
}

