<?php
namespace Clio\Framework\Tests\Schemifier;

use Clio\Framework\Tests\FrameworkTestCase;
use Clio\Framework\Tests\Models;

use Clio\Framework\Metadata\Mapping\Factory\SchemifierMappingFactory;

use Clio\Component\Tool\Normalizer\Normalizer;
use Clio\Framework\Tests\DummyNormalizerStrategy;
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

		$object = $schemifier->schemify(array('dummy'));

		$this->assertInstanceof('Clio\Framework\Tests\Models\TestModel01', $object);
	}

	public function getSchemifierMappingFactory()
	{
		$normalizer = new Normalizer(new DummyNormalizerStrategy(new \ReflectionClass('Clio\Framework\Tests\Models\TestModel01')));

		return new SchemifierMappingFactory(new NormalizerSchemifierFactory($normalizer)); 
	}
}

