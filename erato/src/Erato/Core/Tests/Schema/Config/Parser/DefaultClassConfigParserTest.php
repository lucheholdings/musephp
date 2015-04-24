<?php
namespace Erato\Core\Tests\Schema\Config\Parser;

use Erato\Core\Schema\Config\Parser\DefaultClassConfigParser;
use Clio\Component\Util\Type;

class DefaultClassConfigParserTest extends \PHPUnit_Framework_TestCase 
{
    public function testBasic()
    {
        $parser = new DefaultClassConfigParser(new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault()));

        $config = $parser->parse(new \ReflectionClass('Erato\Core\Tests\Models\SimpleModel'));

        $this->assertInstanceof('Erato\Core\Schema\Config\Configuration', $config);
        $this->assertCount(3, $config->getFields());
    }
}


