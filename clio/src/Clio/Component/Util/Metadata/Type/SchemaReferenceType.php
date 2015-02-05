<?php
namespace Clio\Component\Util\Metadata\Type;

use Clio\Component\Util\Type\AbstractType;

/**
 * SchemaReferenceType 
 * 
 * @uses AbstractType
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaReferenceType extends AbstractType
{
	/**
	 * schemaRegistry 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaRegistry;
    
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
		if($this->schema) {
			$this->schema = $this->getSchemaRegistry()->get($this->name);
		}

		return $schema;
	}

	public function isType($type)
	{
		$schema = $this->getSchema();

		switch($type) {
		case 'class':
			return ($schema instanceof ClassSchema);
		case 'array':
			return ($schema instanceof ArraySchema);
		default:
			if($type == $schema->getName()) {
				// same name
				return true;
			} else if($schema instanceof ClassSchema) {
				return $schema->isImplemented($type) 
					|| $schema->isExtended($type);
			}
		}
		return false;
	}

	public function isValidData($data)
	{
		return $this->getSchema()->isValidData($data);
	}
}

