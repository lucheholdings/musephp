<?php
namespace Erato\Core\Tests;

use Clio\Component\Pce\Metadata\BasicClassMetadataFactory;

use Erato\Core\Metadata\Mapping\Factory\FieldAccessorMappingFactory,
	Erato\Core\Metadata\Mapping\Factory\SchemifierMappingFactory
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


		$schemifierFactory = $this->getSchemifierMappingFactory();

		$this->classMetadataFactory
			->addMappingFactory($this->getSchemifierMappingFactory())
		;
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

