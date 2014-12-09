<?php
namespace Clio\Adapter\DoctrineExtensions\Behavior\Entity\MappedSuperclass;

use Doctrine\ORM\Mapping as ORM;
use Clio\Extra\Model\TaggableModel as BaseModel;

use Clio\Component\Util\Attribute\AttributeMap;
use Clio\Component\Util\Tag\TagSet;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TaggableModel 
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
abstract class TaggableModel extends BaseModel
{
	/**
	 * tags 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $tags;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->tags = new ArrayCollection();
	}
}
