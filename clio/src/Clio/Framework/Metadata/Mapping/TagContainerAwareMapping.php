<?php
namespace Clio\Framework\Metadata\Mapping;

use Clio\Component\Pce\Metadata\AbstractClassMapping;
use Clio\Component\Pce\Metadata\ClassMetadata;

use Clio\Component\Util\Tag\TagContainerAccessor;
use Clio\Component\Util\Tag\TagComponentFactory;

/**
 * TagContainerAwareMapping 
 * 
 * @uses AbstractClassMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TagContainerAwareMapping extends AbstractClassMapping 
{
	/**
	 * tagClass 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tagClass;

	/**
	 * _accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_accessor;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($tagClass)
	{
		$this->tagClass = $tagClass;
	}
    
    /**
     * Get tagClass.
     *
     * @access public
     * @return tagClass
     */
    public function getTagClass()
    {
        return $this->tagClass;
    }
    
    /**
     * Set tagClass.
     *
     * @access public
     * @param tagClass the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTagClass($tagClass)
    {
        $this->tagClass = $tagClass;
        return $this;
    }

	/**
	 * getContainerAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getContainerAccessor()
	{
		if(!$this->_accessor) {
			$this->_accessor = new TagContainerAccessor(new TagComponentFactory($this->getTagClass()));
		}

		return $this->_accessor;
	}
}

