<?php
namespace Erato\Core\Tests\Schemifier;

use Erato\Core\Tests\FrameworkTestCase;
use Erato\Core\Tests\Models;

use Erato\Core\Metadata\Mapping\Factory\SchemifierMappingFactory;

use Erato\Core\Normalizer\AccessorNormalizer;

use Erato\Core\Schemifier\Factory\NormalizerSchemifierFactory;


/**
 * NormalizerSchemifierTest 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NormalizerSchemifierTest extends FrameworkTestCase
{
	public function testSuccess()
	{
		$model = new Models\TestModel01();
		$classMetadata = $this->createClassMetadata($model);

		$schemifier = $classMetadata->getMapping('schemifier')->getSchemifier();

		$this->assertInstanceof('Erato\Core\Schemifier\NormalizerSchemifier', $schemifier);
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Normalizer', $schemifier->getNormalizer());

		$object = $schemifier->schemify(array('privateProperty' => 'private', 'publicProperty' => 'public'));

		$this->assertInstanceof('Erato\Core\Tests\Models\TestModel01', $object);

		$this->assertEquals('private', $object->getPrivateProperty());
		$this->assertEquals('public', $object->publicProperty);
	}

	public function getSchemifierMappingFactory()
	{
		$normalizer = AccessorNormalizer::createDefault();

		return new SchemifierMappingFactory(new NormalizerSchemifierFactory($normalizer)); 
	}
}

