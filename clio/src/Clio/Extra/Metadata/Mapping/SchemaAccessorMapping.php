<?php
namespace Clio\Extra\Metadata\Mapping;

use Clio\Component\Util\Accessor\Schema;
use Clio\Component\Util\Accessor\Schema\ReflectionClassAwarable;
use Clio\Component\Util\Accessor\SimpleSchemaAccessor;
use Clio\Component\Util\Accessor\Schema\AccessorFactory as SchemaAccessorFactory;

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
					$this->fields[$field->getName()] = $field->getMapping('accessor');
				}
			}
		}

		return $this->fields;
	}
}

