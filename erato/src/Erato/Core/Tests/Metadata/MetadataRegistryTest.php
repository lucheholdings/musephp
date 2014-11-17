<?php
namespace Erato\Core\Tests\Metadata;

use Erato\Core\Metadata\MetadataRegistry;
use Clio\Component\Util\Metadata\Schema\Factory\ClassMetadataFactory;

class MetadataRegistryTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * testCosntruct 
	 * 
	 * @access public
	 * @return void
	 */
	public function testCosntruct()
	{
		$registry = new MetadataRegistry(new ClassMetadataFactory());

		$metadata = $registry->get('Erato\Core\Tests\Models\Model01');

		$this->assertInstanceof('Clio\Component\Util\Metadata\Schema\ClassMetadata', $metadata);
	}
}

