<?php
namespace Clio\Framework\Tests\Accessor;

use Clio\Component\Util\Accessor\Tests\SchemaAccessorTestCase;
use Clio\Framework\Tests\Models\AttributeContainerModel;
use Clio\Framework\Accessor\AttributeContainerAccessor;

use Clio\Component\Util\Attribute\AttributeAccessor;
use Clio\Component\Util\Attribute\SimpleAttribute;

class AttributeContainerAccessorTest extends SchemaAccessorTestCase 
{
	protected function getData()
	{
		$attrs = array();
		foreach(parent::getData() as $key => $value) {
			$attrs[] = new SimpleAttribute($key, $value);
		}

		return new AttributeContainerModel($attrs);
	}

	protected function createAccessor()
	{
		return new AttributeContainerAccessor(new AttributeAccessor());
	}
}

