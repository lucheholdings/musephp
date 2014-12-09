<?php
namespace Clio\Component\Util\Metadata\Field;

use Clio\Component\Util\Metadata\FieldMetadata,
	Clio\Component\Util\Metadata\InheritedMetadata
;

class InheritedFieldMetadata extends AbstractFieldMetadata implements InheritedMetadata 
{
	/**
	 * parent 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $parent;

	/**
	 * __construct 
	 * 
	 * @param FieldMetadata $parent 
	 * @param array $fields 
	 * @access public
	 * @return void
	 */
	public function __construct(FieldMetadata $parent, SchemaMetadata $schema = null)
	{
		$this->parent = $parent;

		parent::__construct($schema, $this->parent->getName(), $this->parent->getType());
	}
    
    /**
     * getParent 
     * 
     * @access public
     * @return void
     */
    public function getParent()
    {
        return $this->parent;
    }
    
    /**
     * setParent 
     * 
     * @param FieldMetadata $parent 
     * @access public
     * @return void
     */
    public function setParent(FieldMetadata $parent)
    {
        $this->parent = $parent;
        return $this;
    }

	public function hasMapping($name)
	{
		return parent::hasMapping($name) || $this->getParent()->hasMapping($name);
	}

	public function getMapping($name)
	{
		if(parent::hasMapping($name)) {
			return parent::getMapping($name);
		} else if($this->getParent()->hasMapping($name)) {
			return $this->getParent()->getMapping($name);
		} else {
			throw new \RuntimeException(sprintf('Mapping "%s" is not exists.', $name));
		}

	}

	public function getMappings($includeInherited = true)
	{
		if($includeInherited) {
			return parent::getMappings()->merge($this->getParent()->getMappings());
		} else {
			parent::getMappings();
		}
	}

    
    public function getName()
    {
        return $this->getParent()->getName();
    }
}

