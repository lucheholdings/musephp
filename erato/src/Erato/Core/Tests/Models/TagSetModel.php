<?php
namespace Erato\Core\Tests\Models;

use Clio\Component\Util\Tag\TagSetAware,
	Clio\Component\Util\Tag\TagSet,
	Clio\Component\Util\Tag\TagSet,
	Clio\Component\Util\Tag\SimpleTag
;


class TagSetModel implements TagSetAware 
{
	private $tags;

	public function __construct()
	{
		$this->tags = new TagSet(array(
			new SimpleTag('tag01'),
		));
	}
    
    public function getTags()
    {
        return $this->tags;
    }
    
    public function setTags(TagSet $tags)
    {
        $this->tags = $tags;
        return $this;
    }
}

