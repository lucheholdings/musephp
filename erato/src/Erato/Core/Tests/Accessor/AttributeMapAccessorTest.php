<?php
namespace Erato\Core\Tests\Accessor;

use Clio\Component\Util\Accessor\Tests\SchemaAccessorTestCase;
use Erato\Core\Tests\Models\AttributeMapModel;
use Erato\Core\Accessor\AttributeMapAccessor;

use Clio\Component\Util\Attribute\AttributeAccessor;
use Clio\Component\Util\Attribute\SimpleAttribute;

class AttributeMapAccessorTest extends SchemaAccessorTestCase 
{
	protected function getData()
	{
		$attrs = array();
		foreach(parent::getData() as $key => $value) {
			$attrs[] = new SimpleAttribute($key, $value);
		}

		return new AttributeMapModel($attrs);
	}

	protected function createAccessor()
	{
		return new AttributeMapAccessor(new AttributeAccessor());
	}
}

