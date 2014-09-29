<?php
namespace Calliope\Extension\Location\Model;

use Clio\Frame\Schemify\Core\Model\FlexibleScheme;
use Clio\Frame\Schemify\Core\Model\FlexibleSchemeInterface;
use Calliope\Extension\Location\LocationTags;

use Clio\Component\Tag\Collection\TagCollection;

/**
 * Location 
 * 
 * @uses FlexibleScheme
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Location extends FlexibleScheme
  implements 
    LocationInterface,
    FlexibleSchemeInterface
{
	/**
	 * hash 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $hash;

	/**
	 * name 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $name;

	/**
	 * labelShort 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $labelShort;

	/**
	 * labelLong 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $labelLong;

	/**
	 * tags 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $tags;

	/**
	 * createdAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $createdAt;

	/**
	 * updatedAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $updatedAt;
    
    /**
     * Get hash.
     *
     * @access public
     * @return hash
     */
    public function getHash()
    {
        return $this->hash;
    }
    
    /**
     * Set hash.
     *
     * @access public
     * @param hash the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }
    
    /**
     * Get name.
     *
     * @access public
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set name.
     *
     * @access public
     * @param name the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get tags.
     *
     * @access public
     * @return tags
     */
    public function getTags()
    {
		if(!$this->tags) {
			$this->tags = new TagCollection();
		}
        return $this->tags;
    }
    
    /**
     * Set tags.
     *
     * @access public
     * @param tags the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
        return $this;
    }
    
    /**
     * Get labelShort.
     *
     * @access public
     * @return labelShort
     */
    public function getLabelShort()
    {
        return $this->labelShort;
    }
    
    /**
     * Set labelShort.
     *
     * @access public
     * @param labelShort the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLabelShort($labelShort)
    {
        $this->labelShort = $labelShort;
        return $this;
    }
    
    /**
     * Get labelLong.
     *
     * @access public
     * @return labelLong
     */
    public function getLabelLong()
    {
        return $this->labelLong;
    }
    
    /**
     * Set labelLong.
     *
     * @access public
     * @param labelLong the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLabelLong($labelLong)
    {
        $this->labelLong = $labelLong;
        return $this;
    }

	/**
	 * getTypes 
	 * 
	 * @access public
	 * @return void
	 */
	public function getTypes()
	{
		$types = array();

		foreach($this->getTags()->match(LocationTags::TAG_PREFIX_TYPE, 'prefix') as $type) {
			$types[] = $type;
		}

		return $types;
	}
}

