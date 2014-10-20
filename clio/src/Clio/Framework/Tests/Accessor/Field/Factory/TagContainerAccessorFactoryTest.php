<?php
namespace Clio\Framework\Tests\Accessor\Field\Factory;

use Clio\Framework\Accessor\Field\Factory\TagContainerFieldAccessorFactory;
use Clio\Component\Util\Accessor\Tests\Field\Factory\FieldAccessorFactoryTestCase;

class TagContainerFieldAccessorFactoryTest extends FieldAccessorFactoryTestCase 
{
	protected function getTestSchema()
	{
		return new \ReflectionClass('Clio\Framework\Tests\Models\TagContainerModel');
	}

	protected function getTestFieldName()
	{
		return 'tags';
	}

	protected function createFactory()
	{
		return new TagContainerFieldAccessorFactory();
	}

	protected function getAccessorClass()
	{
		return 'Clio\Framework\Accessor\Field\TagContainerFieldAccessor';
	}
}

