<?php
namespace Clio\Component\Util\Metadata\Type;

use Clio\Component\Util\Type\AbstractType;
use Clio\Component\Util\Type\PrimitiveTypes;
use Clio\Component\Util\Type\FieldContainable;
use Clio\Component\Util\Metadata\SchemaRegistry;
use Clio\Component\Util\Metadata\Schema;

/**
 * SchemaReferenceType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaReferenceType extends AbstractType implements FieldContainable
{
	/**
	 * schemaRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaRegistry;

	/**
	 * schema 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schema;
    
    /**
     * getSchemaRegistry 
     * 
     * @access public
     * @return void
     */
    public function getSchemaRegistry()
    {
		if(!$this->schemaRegistry) {
			throw new \RuntimeException('SchemaRegistry is not initialized yet.');
		}
        return $this->schemaRegistry;
    }
    
    /**
     * setSchemaRegistry 
     * 
     * @param SchemaRegistry $schemaRegistry 
     * @access public
     * @return void
     */
    public function setSchemaRegistry(SchemaRegistry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }

	/**
	 * getSchema 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchema()
	{
		if(!$this->schema) {
			$this->schema = $this->getSchemaRegistry()->get($this->getName());

			if(!$this->schema) {
				throw new \RuntimeException('Failed to resolve schema "%s"', $this->getName());
			}
		}

		return $this->schema;
	}

	public function isType($type)
	{
		$schema = $this->getSchema();

		switch($type) {
		case 'schema':
			return true;
		case PrimitiveTypes::TYPE_OBJECT:
			return ($schema instanceof Schema\ClassMetadata);
		case PrimitiveTypes::TYPE_ARRAY:
			return ($schema instanceof Schema\ArraySchemaMetadata);
		default:
			if($type == $schema->getName()) {
				// same name
				return true;
			} else if($schema instanceof Schema\ClassMetadata) {
				return $schema->isInherited($type);
			}
		}
		return false;
	}

	public function isValidData($data)
	{
		return $this->getSchema()->isValidData($data);
	}

	public function getFieldType($field)
	{
		return $this->getSchema()->getField($field)->getType();
	}

	public function hasFieldType($field)
	{
		return $this->getSchema()->hasField($field);
	}

	public function construct()
	{
		return $this->getSchema()->newInstance();
	}
}

