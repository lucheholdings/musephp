<?php
namespace Erato\Core\Tests\Accessor\Field;

use Clio\Component\Util\Accessor\Tests\Field\FieldAccessorTestCase;
use Erato\Core\Tests\Models\TagSetModel;
use Erato\Core\Accessor\Field\TagSetFieldAccessor;

use Clio\Component\Util\Tag\TagSetAccessor;

class TagSetFieldAccessorTest extends FieldAccessorTestCase 
{
	private $data;

	public function testAccessor()
	{
		$data = $this->getData();
		$accessor = $this->createFieldAccessor('tags');
	}

	protected function getBasicTestField()
	{
		return null;
	}

	protected function getData()
	{
		if(!$this->data) 
			$this->data = new TagSetModel();
		return $this->data;
	}

	protected function getFieldData($field)
	{
		return $this->data->getTags();
	}

	protected function createFieldAccessor($field)
	{
		return new TagSetFieldAccessor(new TagSetAccessor());
	}
}

