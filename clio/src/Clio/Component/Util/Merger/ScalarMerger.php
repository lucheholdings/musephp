<?php
namespace Clio\Component\Util\Merger;

class ScalarMerger implements Merger 
{
	public function merge($oldValue, $newValue)
	{
		return $newValue;
	}
}

