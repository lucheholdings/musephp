<?php
namespace Clio\Component\Util\Attribute;

use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Container\Validator\ClassValidator;

class AttributeMap extends Map implements AttributeContainer
{
	/**
	 * {@inheritdoc}
	 */
	private $owner;

	/**
	 * __construct 
	 * 
	 * @param array $attributes 
	 * @param AttributeContainerAware $owner 
	 * @access public
	 * @return void
	 */
	public function __construct(array $attributes = array(), AttributeContainerAware $owner = null)
	{
		parent::__construct();

		$this->setValueValidator(new ClassValidator('Clio\Component\Util\Attribute\Attribute'));

		$this->owner = $owner;

		foreach($attributes as $attribute) {
			$this->add($attribute);
		}
	}

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setOwner(AttributeContainerAware $owner)
    {
        $this->owner = $owner;
        return $this;
    }

	/**
	 * add 
	 * 
	 * @param Attribute $attribute 
	 * @access public
	 * @return void
	 */
	public function add(Attribute $attribute)
	{
		$this->set($attribute->getKey(), $attribute);
		return $this;
	}
}

