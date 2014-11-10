<?php
namespace Erato\Core\Tests\Accessor\Factory;

use Erato\Core\Accessor\Factory\AttributeMapAccessorFactory;
use Clio\Component\Util\Accessor\Tests\Factory\SchemaAccessorFactoryTestCase;

/**
 * AttributeMapAccessorFactoryTest 
 * 
 * @uses SchemaAccessorFactoryTestCase
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeMapAccessorFactoryTest extends SchemaAccessorFactoryTestCase 
{
	protected function getSchema()
	{
		return new \ReflectionClass('Erato\Core\Tests\Models\AttributeMapModel');
	}

	protected function getAccessorClass()
	{
		return 'Erato\Core\Accessor\AttributeMapAccessor';
	}

	protected function createFactory()
	{
		return new AttributeMapAccessorFactory();
	}
}

