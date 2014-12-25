<?php
namespace Clio\Component\Tool\ArrayTool\Mapper;

use Clio\Component\Util\Container\Map\Map as BaseMap;

/**
 * DummyMapper 
 * 
 * @uses Mapper
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
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

