<?php
namespace Calliope\Framework\Core\Model;

use Clio\Component\Util\Tag\TagContainerAware;
use Clio\Component\Util\Tag\TagContainer;
use Calliope\Framework\Core\Container\TagSet;
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
	/**
	 * tags 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $_tags;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->_tags = new TagSet();
	}
    
    /**
     * Get tags.
     *
     * @access public
     * @return _tags
     */
    public function getTags()
    {
        return $this->_tags;
    }
    
    /**
     * Set tags.
     *
     * @access public
     * @param tags the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTags(TagContainer $tags)
    {
        $this->_tags = $tags;

		$this->_tags->setOwner($this);
        return $this;
    }
}

