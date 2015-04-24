<?php
namespace Erato\Core\Schema\Mapping;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\Schema\ReflectionClassAwarable;
use Clio\Component\Util\Accessor\SimpleSchemaAccessor;
use Clio\Component\Util\Accessor\Schema\AccessorFactory as SchemaAccessorFactory;

use Clio\Component\Util\Accessor\SchemaDataAccessor;
use Clio\Component\Util\Grammer\Grammer;
use Clio\Component\Util\Metadata\Exception as MetadataException;

/**
 * SchemaAccessorMapping 
 * 
 * @uses AccessorMapping
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaAccessorMapping extends AccessorMapping implements Schema, ReflectionClassAwarable
{
	/**
	 * accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessor;

	/**
	 * accessorFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessorFactory;

	/**
	 * fields 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fields;

	/**
	 * getAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAccessor()
	{
		if(!$this->accessor) {
			$this->accessor = $this->getAccessorFactory()->createSchemaAccessor($this);
		}

		return $this->accessor;
	}

	public function createDataAccessor($data)
	{
		return $this->getAccessor()->createDataAccessor($data);
	}

    
    public function getAccessorFactory()
    {
        return $this->accessorFactory;
    }
    
    public function setAccessorFactory(SchemaAccessorFactory $accessorFactory)
    {
        $this->accessorFactory = $accessorFactory;
        return $this;
    }

	public function isReflectionClassAwared()
	{
		return true;
	}

	public function getReflectionClass()
	{
		return $this->getMetadata()->getReflectionClass();
	}

	public function getFields()
	{
		if(!$this->fields) {
			$this->fields = array();
			foreach($this->getMetadata()->getFields() as $field) {
				if($field->hasMapping('accessor')) {
					//$fieldName = Grammer::snakize($field->getName());
					$fieldName = $field->getName();
					$this->fields[$fieldName] = $field->getMapping('accessor');
				}
			}
		}

		return $this->fields;
	}
	
	public function getField($field)
	{
		$fields = $this->getFields();
		if(!isset($fields[$field])) {
			throw new MetadataException\UnknownFieldException(sprintf('Field "%s" is not defined on Accessor Mapping.', $field));
		}

		return $fields[$field];
	}

	public function isSchemaData($data)
	{
		return $this->getMetadata()->isSchemaData($data);
	}
}

