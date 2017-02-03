<?php
namespace Clio\Framework\Tests;

use Clio\Component\Pce\Metadata\BasicClassMetadataFactory;

use Clio\Framework\Metadata\Mapping\Factory\FieldAccessorMappingFactory,
	Clio\Framework\Metadata\Mapping\Factory\SchemifierMappingFactory
;
use Clio\Framework\FieldAccessor\Mapping\Factory\ClassFieldMappingFactory;
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
	/**
	 * classMetadataFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMetadataFactory;

	/**
	 * setUp 
	 * 
	 * @access public
	 * @return void
	 */
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

	/**
	 * getFieldAccessorMappingFactory 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldAccessorMappingFactory()
	{
		return new FieldAccessorMappingFactory(new ClassFieldMappingFactory());
	}

	/**
	 * getSchemifierMappingFactory 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemifierMappingFactory()
	{
		return new SchemifierMappingFactory(new DummySchemifierFactory()); 
	}

	/**
	 * createClassMetadata 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
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

