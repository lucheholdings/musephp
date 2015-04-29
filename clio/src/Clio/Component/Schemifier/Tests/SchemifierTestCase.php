<?php
namespace Clio\Component\Schemifier\Tests;

/**
 * SchemifierTestCase
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class SchemifierTestCase extends \PHPUnit_Framework_TestCase 
{
	/**
	 * testSchemify 
	 * 
	 * @access public
	 * @return void
	 */
	public function testSchemify()
	{
		$schemifier = $this->getSchemifier();

		$model = $schemifier->schemify($data);

		$this->assertInstanceOf($schemifier->getSchemeClass(), $model);

		$this->assertEquals($data['foo'], $model->getFoo());
		$this->assertEquals($data['bar'], $model->getBar());
	}

	/**
	 * getSchemifier 
	 * 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function getSchemifier();
}

