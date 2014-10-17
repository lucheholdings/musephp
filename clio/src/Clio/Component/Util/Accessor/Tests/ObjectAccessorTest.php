<?php
namespace Clio\Component\Util\Accessor\Tests;

use Clio\Component\Util\Accessor\Tests\Models;

class ObjectAccessorTest extends AbstractAccessorTest
{
	const ACCESSOR_CLASS = 'Clio\Component\Util\Accessor\ObjectAccessor';

	protected function getDefaultData()
	{
		return new Models\AccessorTestModel();
	}

	/**
	 * createAccessor 
	 * 
	 * @param mixed $data 
	 * @access protected
	 * @return void
	 */
	protected function createAccessor($data = null)
	{
		if(!$data) {
			$data = $this->getDefaultData();
		}

		$class = self::ACCESSOR_CLASS;
		return new $class($this->createClassAccessor($data), $data);
	}

	protected function createClassAccessor($data)
	{
		return new ClassAccessor();
	}
}

