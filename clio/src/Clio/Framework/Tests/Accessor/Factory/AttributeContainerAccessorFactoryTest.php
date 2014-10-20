<?php
namespace Clio\Framework\Tests\Accessor\Factory;

use Clio\Framework\Accessor\Factory\AttributeContainerAccessorFactory;
use Clio\Component\Util\Accessor\Tests\Factory\SchemaAccessorFactoryTestCase;

/**
 * AttributeContainerAccessorFactoryTest 
 * 
 * @uses SchemaAccessorFactoryTestCase
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class AttributeContainerAccessorFactoryTest extends SchemaAccessorFactoryTestCase 
{
	protected function getSchema()
	{
		return new \ReflectionClass('Clio\Framework\Tests\Models\AttributeContainerModel');
	}

	protected function getAccessorClass()
	{
		return 'Clio\Framework\Accessor\AttributeContainerAccessor';
	}

	protected function createFactory()
	{
		return new AttributeContainerAccessorFactory();
	}
}

