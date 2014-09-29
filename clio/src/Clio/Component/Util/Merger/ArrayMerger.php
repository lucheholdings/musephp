<?php
namespace Clio\Component\Util\Merger;

class ArrayMerger implements Merger 
{
	public function merge($oldValue, $newValue)
	{
		return array_merge($oldValue, $newValue);
	}
}

