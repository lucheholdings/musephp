<?php
namespace Clio\Component\Merger;

class ArrayMerger implements Merger 
{
	public function merge($oldValue, $newValue)
	{
		return array_merge($oldValue, $newValue);
	}
}

