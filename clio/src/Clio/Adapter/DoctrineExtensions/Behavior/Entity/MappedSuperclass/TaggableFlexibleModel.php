<?php
namespace Clio\Adapter\DoctrineExtensions\Behavior\Entity\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Clio\Extra\Model\TaggableFlexibleModel as BaseModel;

use Clio\Component\Util\Attribute\AttributeMap;
use Clio\Component\Util\Tag\TagSet;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\Common\Collections\ArrayCollection;

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
}
