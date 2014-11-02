<?php
namespace Calliope\Framework\Core\Tests;

use Calliope\Framework\Core\Container\AttributeMap;
use Clio\Component\Tag\Collection\TagSet;
use Calliope\Framework\Core\Model\Attribute,
	Calliope\Framework\Core\Model\SchemaModelInterface,
	Clio\Component\Tag\Tag;

use Clio\Component\Serializer\Object\ArraySerializable,
	Clio\Component\Serializer\Object\ArrayDeserializable;

/**
 * TestFlexibleModel
 * 
 * @uses TaggableFlexibleModelModel
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 */
class TestModel implements 
	SchemaModelInterface,
	ArraySerializable,	
	ArrayDeserializable	
{
	/**
	 * hash 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $hash;

	/**
	 * createdAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $createdAt;

	/**
	 * updatedAt 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $updatedAt;

	/**
	 * label 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $label;
	
	/**
	 * name 
	 * 
	 * @var mixed
	 * @access protected
	 * 
	 */
	protected $name;

	public function __construct($label = null, $name = null)
	{
		$this->label = $label;
		$this->name = $name;
	}


    
    /**
     * Get hash.
     *
     * @access public
     * @return hash
     */
    public function getHash()
    {
        return $this->hash;
    }
    
    /**
     * Set hash.
     *
     * @access public
     * @param hash the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
        return $this;
    }
    
    /**
     * Get createdAt.
     *
     * @access public
     * @return createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Set createdAt.
     *
     * @access public
     * @param createdAt the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    
    /**
     * Get updatedAt.
     *
     * @access public
     * @return updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Set updatedAt.
     *
     * @access public
     * @param updatedAt the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    
    /**
     * Get label.
     *
     * @access public
     * @return label
     */
    public function getLabel()
    {
        return $this->label;
    }
    
    /**
     * Set label.
     *
     * @access public
     * @param label the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
    
    /**
     * Get name.
     *
     * @access public
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set name.
     *
     * @access public
     * @param name the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

	public function serializeArray()
	{
	}

	public function deserializeArray(array $resource)
	{
		$this->label = isset($resource['label']) ? $resource['label'] : null;
		$this->name = isset($resource['name']) ? $resource['name'] : null;
	}
}

