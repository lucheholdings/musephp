<?php
namespace Clio\Component\Util\Metadata\Schema;

use Clio\Component\Util\Metadata\SchemaMetadata,
	Clio\Component\Util\Metadata\InheritedMetadata,
	Clio\Component\Util\Metadata\Field\InheritedFieldMetadata
;
/**
 * InheritSchemaMetadata 
 * 
 * @uses AbstractSchemaMetadata
 * @uses InheritMetadata
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class InheritedSchemaMetadata extends AbstractSchemaMetadata implements InheritedMetadata 
{
	/**
	 * parent 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $parent;

	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * __construct 
	 * 
	 * @param SchemaMetadata $parent 
	 * @param array $fields 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaMetadata $parent, $name)
	{
		$this->parent = $parent;
		$this->name = $name;

		$fields = array();
		foreach($parent->getFields() as $fieldName => $field) {
			$fields[$fieldName] = new InheritedFieldMetadata($field);
		}
		parent::__construct($fields);
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
     * @param SchemaMetadata $parent 
     * @access public
     * @return void
     */
    public function setParent(SchemaMetadata $parent)
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
			return $this->getParent()->getMappings()->merge(parent::getMappings());
		} else {
			return parent::getMappings();
		}
	}

    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	public function isSchemaData($data)
	{
		return $this->getParent()->isSchemaData($data);
	}
}

