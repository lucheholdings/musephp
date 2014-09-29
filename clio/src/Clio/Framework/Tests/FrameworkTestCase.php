<?php
namespace Clio\Framework\Tests;

use Clio\Component\Pce\Metadata\BasicClassMetadataFactory;

use Clio\Framework\Metadata\Mapping\Factory\FieldAccessorMappingFactory,
	Clio\Framework\Metadata\Mapping\Factory\SchemifierMappingFactory
;
/**
 * FrameworkTestCase 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class FrameworkTestCase extends \PHPUnit_Framework_TestCase 
{
	private $classMetadataFactory;

	public function setUp()
	{
		$this->classMetadataFactory = new BasicClassMetadataFactory();

		$fieldAccessorFactory = $this->getFieldAccessorMappingFactory();

		$schemifierFactory = $this->getSchemifierMappingFactory();

		$this->classMetadataFactory
			->addMappingFactory($this->getFieldAccessorMappingFactory())
			->addMappingFactory($this->getSchemifierMappingFactory())
		;
	}

	public function getFieldAccessorMappingFactory()
	{
		return new FieldAccessorMappingFactory();
	}

	public function getSchemifierMappingFactory()
	{
		return new SchemifierMappingFactory(new DummySchemifierFactory()); 
	}

	public function createClassMetadata($class)
	{
		return $this->getClassMetadataFactory()->createClassMetadata($class);
	}
	/**
	 * getClassMetadataFactory 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClassMetadataFactory()
	{
		return $this->classMetadataFactory;
	}
}

