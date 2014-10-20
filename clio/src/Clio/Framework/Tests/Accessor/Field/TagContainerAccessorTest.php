<?php
namespace Clio\Framework\Tests\Accessor\Field;

use Clio\Component\Util\Accessor\Tests\Field\FieldAccessorTestCase;
use Clio\Framework\Tests\Models\TagContainerModel;
use Clio\Framework\Accessor\Field\TagContainerFieldAccessor;

use Clio\Component\Util\Tag\TagContainerAccessor;

class TagContainerFieldAccessorTest extends FieldAccessorTestCase 
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
			$this->data = new TagContainerModel();
		return $this->data;
	}

	protected function getFieldData($field)
	{
		return $this->data->getTags();
	}

	protected function createFieldAccessor($field)
	{
		return new TagContainerFieldAccessor(new TagContainerAccessor());
	}
}

