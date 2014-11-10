<?php
namespace Calliope\Adapter\Doctrine\Core\Entity\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Calliope\Framework\Core\Model\FlexibleModel as BaseModel;

use Clio\Component\Util\Attribute\AttributeMap;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
/**
 * FlexibleModel 
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
abstract class FlexibleModel extends BaseModel 
{
	/**
	 * createdAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 * @ORM\Column(name="updated_at", type="datetime", nullable=false)
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
	 * @param AttributeMap $attributes 
	 * @access public
	 * @return void
	 */
	public function setAttributes(AttributeMap $attributes)
	{
		parent::setAttributes($attributes);

		if($attributes instanceof DoctrineCollection) {
			$this->attributes = $attributes;
		} else if($attributes instanceof DoctrineProxyContainer) {
			$this->attributes = $attributes->getDoctrineCollection();
		}

		return $this;
	}
}
