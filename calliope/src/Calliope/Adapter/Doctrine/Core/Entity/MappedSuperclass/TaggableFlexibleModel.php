<?php
namespace Calliope\Adapter\Doctrine\Core\Entity\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Calliope\Framework\Core\Model\TaggableFlexibleModel as BaseModel;

use Clio\Component\Util\Attribute\AttributeContainer;
use Clio\Component\Util\Tag\TagContainer;
use Clio\Bridge\Doctrine\Container\ProxyAttributeMap;
use Clio\Bridge\Doctrine\Container\ProxyTagSet;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\Common\Collections\ArrayCollection;
use Clio\Bridge\Doctrine\Container\ProxyContainer;

/**
 * TaggableFlexibleModel 
 * 
 * @uses BaseModel
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 */
abstract class TaggableFlexibleModel extends BaseModel
{
	/**
	 * attributes 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $attributes;

	/**
	 * tags 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $tags;

	/**
	 * createdAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="created_at", type="datetime", nullable=false)
	 */
	protected $createdAt;

	/**
	 * updatedAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="updated_at", type="datetime", nullable=false)
	 */
	protected $updatedAt;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->attributes = new ArrayCollection();
		$this->tags = new ArrayCollection();
	}

	/**
	 * doTimestampOnPrePersist 
	 * 
	 * @access public
	 * @return void
	 * 
	 * @ORM\PrePersist
	 */
	public function doTimestampOnPrePersist()
	{
		$this->createdAt = $this->updatedAt = new \DateTime();
	}

	/**
	 * doTimestampOnPreUpdate 
	 * 
	 * @access public
	 * @return void
	 * 
	 * @ORM\PreUpdate
	 */
	public function doTimestampOnPreUpdate()
	{
		$this->updatedAt = new \DateTime();
	}

    /**
     * Get attributes.
     *
     * @access public
     * @return attributes
     */
    public function getAttributes()
    {
		$attributes = parent::getAttributes();
		if(!$attributes) {
			if($this->attributes instanceof DoctrineCollection) {
				$attributes = new ProxyAttributeMap($this->attributes, $this);
				$this->setAttributes($attributes);
			}
		}

		return $attributes;
    }

	/**
	 * setAttributes 
	 * 
	 * @param AttributeContainer $attributes 
	 * @access public
	 * @return void
	 */
	public function setAttributes(AttributeContainer $attributes)
	{
		parent::setAttributes($attributes);

		if($attributes instanceof DoctrineCollection) {
			$this->attributes = $attributes;
		} else if($attributes instanceof ProxyContainer) {
			$this->attributes = $attributes->getDoctrineCollection();
		}

		return $this;
	}

    /**
     * getTags 
     * 
     * @access public
     * @return void
     */
    public function getTags()
    {
		$tags = parent::getTags();

		if(!$tags) {
			if($this->tags instanceof DoctrineCollection) {
				// Doctrine PersistCollection
				$tags = new ProxyTagSet($this->tags, $this);
				$this->setTags($tags);
			}
		}
        return $tags;
    }

	/**
	 * setTags 
	 * 
	 * @param TagContainer $tags 
	 * @access public
	 * @return void
	 */
	public function setTags(TagContainer $tags)
	{
		parent::setTags($tags);

		if($tags instanceof DoctrineCollection) {
			$this->tags = $tags;
		} else if($tags instanceof ProxyContainer) {
			$this->tags = $tags->getDoctrineCollection();
		}

		return $this;
	}
}
