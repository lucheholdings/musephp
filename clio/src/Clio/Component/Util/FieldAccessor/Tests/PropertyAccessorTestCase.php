<?php
namespace Clio\Component\Util\FieldAccessor\Tests;

abstract class PropertyAccessorTestCase extends \PHPUnit_Framework_TestCase 
{
	protected $accessor;

	abstract protected function getAccessor();

	abstract protected function createModel();
}

