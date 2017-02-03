<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\Tool\ArrayTool;

use Clio\Component\Util\Container\Map\Map as BaseMap;

class DummyMapper implements Mapper 
{
	public function map(array $values)
	{
		return $values;
	}

	public function inverseMap(array $values)
	{
		return $values;
	}
}

