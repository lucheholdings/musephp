<?php
namespace Clio\Component\Util\FieldAccessor\Tests\Property;

/**
 * PropertyFieldAccessorTestCase 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class PropertyFieldAccessorTestCase extends \PHPUnit_Framework_TestCase
{
	protected $accessor;

	protected $field;

	abstract protected function getAccessor();

	abstract protected function getField();

	abstract protected function createModel();
}

