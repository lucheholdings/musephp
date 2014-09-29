<?php
namespace Calliope\Framework\Core\Tests;

use Clio\Component\Pattern\Factory\Tests\ComponentBuilderTestCase;
use Calliope\Framework\Core\Builder\SchemeModelBuilder;

use Clio\Component\Pce\Metadata\BasicClassMetadataFactory;
use Clio\Framework\Metadata\Mapping\Factory\FieldAccessorMappingFactory;

/**
 * SchemeModelBuilderTest 
 * 
 * @uses BuilderTestCase
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemeModelBuilderTest extends ComponentBuilderTestCase
{
	/**
	 * testBuildWithAttribute 
	 * 
	 * @access public
	 * @return void
	 */
	public function testBuildWithAttribute()
	{
		$builder = $this->createBuilder(($this->getBuiltClass()));

		$builder->getAttributes()
			->set('hoge', 'Hoge')
			->set('foo', 'Foo')
			->set('bar', 'Bar')
		;

		$model = $builder->build();
	
		// Check attributes
		$this->assertCount(3, $model->getAttributes());
		$this->assertEquals('Foo', $model->getAttributes()->get('foo'));
		$this->assertEquals('Bar', $model->getAttributes()->get('bar'));
		$this->assertEquals('Hoge', $model->getAttributes()->get('hoge'));
	}

	public function testBuildWithTags()
	{
		$builder = $this->createBuilder(($this->getBuiltClass()));

		$builder->set('tags', array('foo', 'bar', 'hoge'));

		$model = $builder->build();
	
		// Check attributes
		$this->assertCount(3, $model->getTags());
		$this->assertTrue($model->getTags()->has('foo'));
		$this->assertTrue($model->getTags()->has('hoge'));
		$this->assertTrue($model->getTags()->has('bar'));
	}

	public function getBuilderClass()
	{
		return 'Calliope\Framework\Core\Builder\SchemeModelBuilder';
	}

	/**
	 * getBuiltClass 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function getBuiltClass()
	{
		return $this->getClassMetadataFactory()->create('Calliope\Framework\Core\Tests\TestFlexibleSchemeModel');
	}

	/**
	 * getClassMetadataFactory 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClassMetadataFactory()
	{
		if(!$this->classMetadataFactory) {
			$this->classMetadataFactory = new BasicClassMetadataFactory();

			$this->classMetadataFactory->addMappingFactory(new FieldAccessorMappingFactory());
		}

		return $this->classMetadataFactory;
	}

	private $classMetadataFactory;
}
