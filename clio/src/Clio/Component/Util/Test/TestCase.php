<?php
namespace Clio\Component\Util\Test;

/**
 * TestCase 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TestCase extends \PHPUnit_Framework_TestCase 
{
	/**
	 * assertThrowException 
	 * 
	 * @param mixed $expected 
	 * @param \Closure $closure 
	 * @access protected
	 * @return void
	 */
	protected function assertThrowException($expected, \Closure $closure) 
	{
		if(!class_exists($expected) || !is_subclass_of($expected, '\Exception')) {
			throw new \InvalidArgumentException('Argument 1 of assertThrowException() has to be a classname of Exception.');
		}

		try {
			$closure();
			$this->fail(sprintf('Exception "%s" is expected to be thrown, but exception is not occured.', $expected));
		} catch(\Exception $ex) {
			$ref = new \ReflectionClass($expected);
			if(!$ref->isInstance($ex)) {
				$this->fail(sprintf('Exception "%s" is expected to be thrown, but "%s" is thrown.', $expected, get_class($ex)));
			}
			
			$this->assertTrue(true);
		}
	}
}

