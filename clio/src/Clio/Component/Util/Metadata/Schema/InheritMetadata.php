<?php
namespace Clio\Component\Util\Metadata\Schema;

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
class InheritSchemaMetadata extends AbstractSchemaMetadata implements InheritMetadata 
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
	 * @param SchemaMetadata $parent 
	 * @param array $fields 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaMetadata $parent, array $fields = array())
	{
		parent::__construct($fields);
		$this->parent = $parent;
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
			return merge(parent::getMappings(), $this->getParent()->getMappings());
		} else {
			parent::getMappings();
		}
	}

}

