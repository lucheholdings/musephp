<?php
namespace Clio\Bridge\Doctrine\Container;

use Clio\Component\Util\Attribute\AttributeContainer;
use Clio\Component\Util\Attribute\AttributeContainerAware;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\PersistentCollection;

/**
 * ProxyAttributeMap 
 * 
 * @uses KeyValueProxyCollection
 * @uses AttributeCollectionInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyAttributeMap extends ProxyMap implements AttributeContainer
{
	/**
	 * owner 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $owner;

	/**
	 * __construct 
	 * 
	 * @param DoctrineCollection $source 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	public function __construct(DoctrineCollection $source, $owner = null)
	{
		parent::__construct($source);
		$this->owner = $owner;
	}

	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOwner()
	{
		if(!$this->owner && ($this->getReference() instanceof PersistentCollection)) {
			$this->owner = $this->getReference()->getOwner();
		}
		return $this->owner;
	}

	/**
	 * setOwner 
	 * 
	 * @param AttributeContainerAware $owner 
	 * @access public
	 * @return void
	 */
	public function setOwner(AttributeContainerAware $owner)
	{
		$this->owner = $owner;
		
		foreach($this as $element) {
			$element->setOwner($this->owner);
		}
	}

	/**
	 * set
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		$value->setOwner($this->getOwner());
		return parent::set($key, $value);
	}
}
