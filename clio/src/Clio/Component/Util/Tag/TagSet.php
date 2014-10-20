<?php
namespace Clio\Component\Util\Tag;

use Clio\Component\Util\Container\Set\Set;

class TagSet extends Set implements TagContainer
{
	public function containsName($name)
	{
		return in_array($name, $this->toArray());
	}

	public function getNameArray()
	{
		return array_map(function($tag) {
			return $tag->getName();	
		}, $this->toArray());
	}
}

