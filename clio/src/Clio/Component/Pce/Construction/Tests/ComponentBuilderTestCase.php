<?php
namespace Clio\Component\Pce\Construction\Tests;

/**
 * ComponentBuilderTestCase 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class ComponentBuilderTestCase extends \PHPUnit_Framework_TestCase
{
	/**
	 * reflectionBuilderClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflectionBuilderClass;

	/**
	 * testBuild 
	 * 
	 * @access public
	 * @return void
	 */
	public function testCreate()
	{
		$builder = $this->createBuilder($this->getBuiltClass());

		$this->assertInstanceOf($this->getBuilderClass(), $builder);
	}

	/**
	 * createBuilder 
	 * 
	 * @abstract
	 * @params $args... Arugment of Builder Constructor
	 * @access protected
	 * @return void
	 */
	protected function createBuilder()
	{
		if(!$this->reflectionBuilderClass) {
			$this->reflectionBuilderClass = new \ReflectionClass($this->getBuilderClass());
		}

		return $this->reflectionBuilderClass->newInstanceArgs(func_get_args());
	}

	abstract protected function getBuilderClass();

	/**
	 * getBuiltClass 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function getBuiltClass();
}

