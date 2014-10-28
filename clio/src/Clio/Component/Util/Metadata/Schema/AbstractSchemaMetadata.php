<?php
namespace Clio\Component\Util\Metadata\Schema;

use Clio\Component\Util\Metadata\AbstractMetadata;
use Clio\Component\Util\Metadata\SchemaMetadata;
use Clio\Component\Util\Metadata\FieldMetadata;
use Clio\Component\Util\Metadata\Mapping\MappingCollection;

/**
 * AbstractSchemaMetadata 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemaMetadata extends AbstractMetadata implements SchemaMetadata 
{
	/**
	 * fields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fields;

	/**
	 * __construct 
	 * 
	 * @param array $fields 
	 * @access public
	 * @return void
	 */
	public function __construct(array $fields = array())
	{
		$this->fields = array();

		foreach($fields as $field) {
			$this->addField($field);
		}
	}
    
    /**
     * getFields 
     * 
     * @access public
     * @return void
     */
    public function getFields()
    {
        return $this->fields;
    }
    
    /**
     * setFields 
     * 
     * @param array $fields 
     * @access public
     * @return void
     */
    public function setFields(array $fields)
    {
        $this->fields = array();
		foreach($fields as $field) {
			$this->addField($field);
		}
        return $this;
    }

	/**
	 * hasField 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasField($name)
	{
		return isset($this->fields[$name]);
	}

	/**
	 * getField 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getField($name)
	{
		return $this->fields[$name];
	}

	/**
	 * addField 
	 * 
	 * @param FieldMetadata $field 
	 * @access public
	 * @return void
	 */
	public function addField(FieldMetadata $field)
	{
		$this->fields[$field->getName()] = $field;
		return $this;
	}

	public function serialize()
	{
		return serialize(array(
			$this->getFields(),
			$this->getMappings()->toArray()
		));
	}

	public function unserialize($serialized)
	{
		$data = unserialize($serialized);
		if(!$data) {
			throw new \RuntimeException(sprintf('Failed to unserialize "%s"', __CLASS__));
		}

		list(
			$this->fields,
			$mappings
		) = $data;

		$this->setMappings(new MappingCollection($mappings));
	}
}

