<?php
namespace Erato\Core\Tests\Schema\Registry;

use Erato\Core\Schema\Registry\BasicRegistry;
use Clio\Component\Type;
use Clio\Component\Metadata;

class BasicRegistryTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testCosntruct 
	 * 
	 * @access public
	 * @return void
	 */
	public function testCosntruct()
	{
		$registry = BasicRegistry::createDefault(
                new Metadata\Resolver\LazyResolver(new Metadata\Resolver\RegisteredResolver()),
                new Type\Resolver\RegisteredResolver(Type\Registry\Factory::createDefault())
            );

		$metadata = $registry->get('Erato\Core\Tests\Models\SimpleModel');
		$this->assertInstanceof('Clio\Component\Metadata\Schema', $metadata);

        $this->assertEquals('Erato\Core\Tests\Models\SimpleModel', $metadata->getName());
        $this->assertCount(3, $metadata->getFields());
	}
}

