<?php
namespace Erato\Core\Tests\Accessor\Field\Factory;

use Erato\Core\Accessor\Field\Factory\TagSetFieldAccessorFactory;
use Clio\Component\Util\Accessor\Tests\Field\Factory\FieldAccessorFactoryTestCase;

class TagSetFieldAccessorFactoryTest extends FieldAccessorFactoryTestCase 
{
	protected function getTestSchema()
	{
		return new \ReflectionClass('Erato\Core\Tests\Models\TagSetModel');
	}

	protected function getTestFieldName()
	{
		return 'tags';
	}

	protected function createFactory()
	{
		return new TagSetFieldAccessorFactory();
	}

	protected function getAccessorClass()
	{
		return 'Erato\Core\Accessor\Field\TagSetFieldAccessor';
	}
}

