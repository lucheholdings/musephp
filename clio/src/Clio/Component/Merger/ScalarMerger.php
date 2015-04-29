<?php
namespace Clio\Component\Merger;

class ScalarMerger implements Merger 
{
	public function merge($oldValue, $newValue)
	{
		return $newValue;
	}
}

