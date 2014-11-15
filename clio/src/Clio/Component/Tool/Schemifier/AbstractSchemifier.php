<?php
namespace Clio\Component\Tool\Schemifier;

use Clio\Component\Tool\ArrayTool\KeyMapper;
use Clio\Component\Tool\ArrayTool\DummyMapper;

/**
 * AbstractSchemifier 
 * 
 * @uses Schemifier
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemifier implements Schemifier 
{
	/**
	 * schema 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $schema;

	/**
	 * maps 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldKeyMappers;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($schema, Map $fieldKeyMappers = null)
	{
		$this->schema = $schema;
		$this->fieldKeyMappers = $fieldKeyMappers;
	}

	/**
	 * schemify 
	 * 
	 * @param mixed $data 
	 * @access public
	 * @return void
	 */
	final public function schemify($data)
	{
		if($this->schema->isValidData($data)) {
			return $data;		
		} else {
			return $this->doSchemify($data);
		}
	}

	abstract protected function doSchemify($data);
    
    /**
     * Set schema.
     *
     * @access public
     * @param schema the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSchema(Schema $schema)
    {
        $this->schema = $schema;
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
		return $this->schema;
	}
    
	/**
	 * hasDefaultFieldMapper 
	 * 
	 * @param mixed $resourceType 
	 * @access public
	 * @return void
	 */
	public function hasDefaultFieldMapper($resourceType)
	{
		return $this->getFieldMapperRegistry()->has($resourceType, $this->getSchemeClass());
	}

	public function getFieldKeyMapper($sourceType)
	{
		$fieldKeyMapper = null;

		if($this->getFieldKeyMappers()->has($sourceType)) {
			$fieldKeyMapper = $this->getFieldKeyMappers()->get($sourceType);
		} else {
			$fieldKeyMapper = new DummyFieldMapper();
		}

		return $fieldKeyMapper;
	}
    
    public function getFieldKeyMappers()
    {
		if(!$this->fieldKeyMappers) {
			$this->fieldKeyMappers = new Map();
		}
        return $this->fieldKeyMappers;
    }
    
    public function setFieldKeyMappers($fieldKeyMappers)
    {
        $this->fieldKeyMappers = $fieldKeyMappers;
        return $this;
    }
}

