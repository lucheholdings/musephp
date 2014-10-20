<?php
namespace Clio\Framework\Tests\Models;

use Clio\Component\Util\Tag\TagContainerAware,
	Clio\Component\Util\Tag\TagContainer,
	Clio\Component\Util\Tag\TagSet,
	Clio\Component\Util\Tag\SimpleTag
;


class TagContainerModel implements TagContainerAware 
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
    
    public function setTags(TagContainer $tags)
    {
        $this->tags = $tags;
        return $this;
    }
}

