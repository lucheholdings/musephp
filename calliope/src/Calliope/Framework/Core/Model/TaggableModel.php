<?php
namespace Calliope\Framework\Core\Model;

use Clio\Component\Util\Tag\TagSetAware;
use Clio\Component\Util\Tag\TagSet;
use Calliope\Framework\Core\Container\TagSet;

use Clio\Bridge\DoctrineCollection\Container\Storage\DoctrineCollectionStorage;
/**
 * TaggbleModel 
 * 
 * @uses Model
 * @uses TagSetAware
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TaggableModel extends Model implements TagSetAware 
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
    
    public function setTagSet(TagSet $set)
    {
        $this->_tags = $set;
		$this->tags = $set->getRaw();

        return $this;
    }
}

