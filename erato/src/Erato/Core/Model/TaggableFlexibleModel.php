<?php
namespace Erato\Core\Model;

use Clio\Component\Util\Tag\TagSetAware;
use Clio\Component\Util\Tag\TagSet as TagSetInterface;
use Clio\Component\Util\Tag\SimpleTagSet;

use Clio\Bridge\DoctrineCollection\Container\Storage\DoctrineCollectionStorage;
/**
 * TaggbleFlexibleModel 
 * 
 * @uses FlexibleModel
 * @uses TagSetAware
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TaggableFlexibleModel extends FlexibleModel implements TagSetAware 
{
	/**
	 * tags 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $tags;

	/**
	 * _tags 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_tags;
    
    /**
     * getTags 
     * 
     * @access public
     * @return void
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    /**
     * setTags 
     * 
     * @param mixed $tags 
     * @access public
     * @return void
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

		$this->_tags = null;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getTagSet()
    {
		if(!$this->_tags) {
			$this->_tags = new SimpleTagSet(array(), new DoctrineCollectionStorage($this->tags));
		}
        return $this->_tags;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setTagSet(TagSetInterface $set)
    {
        $this->_tags = $set;
		$this->tags = $set->getRaw();

        return $this;
    }
}

