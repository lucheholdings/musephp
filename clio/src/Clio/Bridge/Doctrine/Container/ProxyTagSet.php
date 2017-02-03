<?php
namespace Clio\Bridge\Doctrine\Container;

use Clio\Component\Util\Tag\TagContainer;
use Clio\Component\Util\Tag\TagContainerAware;

use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\ORM\PersistentCollection;

/**
 * ProxyTagSet 
 * 
 * @uses ProxySet
 * @uses TagContainer
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyTagSet extends ProxySet implements TagContainer
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
			return parent::getOwner();
		}
		return $this->owner;
	}

	/**
	 * setOwner 
	 * 
	 * @param TagContainerAware $owner 
	 * @access public
	 * @return void
	 */
	public function setOwner(TagContainerAware $owner)
	{
		$this->owner = $owner;
		
		foreach($this as $element) {
			$element->setOwner($this->owner);
		}
	}

	/**
	 * add 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function add($value)
	{
		$value->setOwner($this->getOwner());

		return parent::add($value);
	}

	public function containsName($name)
	{
		return $this->exists(function($element) use ($name) {
			return $name == $element;
		});
	}

	/**
	 * getScalarValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScalarValues()
	{
		$values = array();
		foreach($this as $element) {
			$values[] = $element->getName();
		}
		return $values;
	}

	/**
	 * getNameArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function getNameArray()
	{
		return $this->getScalarValues();
	}

	public function remove($value)
	{
		$removes = $this->getDoctrineCollection()->filter(function($element) use ($value) {
			return $value === $element->getName();
		});

		foreach($removes as $key => $value) {
			$this->getDoctrineCollection()->remove($key);
		}
	}
}
