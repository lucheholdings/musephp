<?php
namespace Calliope\Framework\Core\Model;

use Clio\Component\Util\Tag\TagContainerAware;
use Clio\Component\Util\Tag\TagContainer;
use Calliope\Framework\Core\Container\TagSet;

use Clio\Bridge\DoctrineCollection\Container\Storage\DoctrineCollectionStorage;
/**
 * TaggbleFlexibleModel 
 * 
 * @uses FlexibleModel
 * @uses TagContainerAware
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TaggableFlexibleModel extends FlexibleModel implements TagContainerAware 
{
	protected $tags;

	private $_tags;
    
    public function getTags()
    {
        return $this->tags;
    }
    
    public function setTags($tags)
    {
        $this->tags = $tags;

		$this->_tags = null;
        return $this;
    }
    
    public function getTagSet()
    {
		if(!$this->_tags) {
			$this->_tags = new TagSet(array(), new DoctrineCollectionStorage($this->tags));
		}
        return $this->_tags;
    }
    
    public function setTagSet(TagContainer $set)
    {
        $this->_tags = $set;
		$this->tags = $set->getRaw();

        return $this;
    }
}

