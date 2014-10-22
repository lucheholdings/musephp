<?php
namespace Clio\Framework\Tests\Schemifier;

use Clio\Framework\Tests\FrameworkTestCase;
use Clio\Framework\Tests\Models;

use Clio\Framework\Metadata\Mapping\Factory\SchemifierMappingFactory;

use Clio\Framework\Normalizer\AccessorNormalizer;

use Clio\Framework\Schemifier\Factory\NormalizerSchemifierFactory;


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

		$this->assertInstanceof('Clio\Framework\Schemifier\NormalizerSchemifier', $schemifier);
		$this->assertInstanceof('Clio\Component\Tool\Normalizer\Normalizer', $schemifier->getNormalizer());

		$object = $schemifier->schemify(array('privateProperty' => 'private', 'publicProperty' => 'public'));

		$this->assertInstanceof('Clio\Framework\Tests\Models\TestModel01', $object);

		$this->assertEquals('private', $object->getPrivateProperty());
		$this->assertEquals('public', $object->publicProperty);
	}

	public function getSchemifierMappingFactory()
	{
		$normalizer = AccessorNormalizer::createDefault();

		return new SchemifierMappingFactory(new NormalizerSchemifierFactory($normalizer)); 
	}
}

