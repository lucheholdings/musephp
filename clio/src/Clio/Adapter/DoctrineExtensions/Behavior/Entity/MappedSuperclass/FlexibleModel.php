<?php
namespace Clio\Adapter\DoctrineExtensions\Behavior\Entity\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Clio\Extra\Model\FlexibleModel as BaseModel;

use Clio\Component\Attribute\AttributeMap;

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
     * Get attributes.
     *
     * @access public
     * @return _attributes
     */
    public function getAttributeMap()
    {
		if(!$this->_attributes) {
			$this->_attributes = new AttributeMap(array(), new DoctrineCollectionStorage($this->attributes));
		}
        return $this->_attributes;
    }
}
