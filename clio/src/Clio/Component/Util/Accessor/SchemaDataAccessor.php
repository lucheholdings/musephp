<?php
namespace Clio\Component\Util\Accessor;

/**
 * SchemaDataAccessor 
 * 
 * @uses Accessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SchemaDataAccessor implements Accessor 
{
	/**
	 * schemaAccessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaAccessor;

	/**
	 * data 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $data;

	/**
	 * __construct 
	 * 
	 * @param SchemaAccessor $schemaAccessor 
	 * @param object $data 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaAccessor $schemaAccessor, $data)
	{
		$this->schemaAccessor = $schemaAccessor;
		$this->data = $data;
	}

	/**
	 * get 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($field)
	{
		return $this->getSchemaAccessor()->get($this->getData(), $field);
	}

	/**
	 * set 
	 * 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($field, $value)
	{
		$this->getSchemaAccessor()->set($this->getData(), $field, $value);
		return $this;
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isNull($field)
	{
		return $this->getSchemaAccessor()->isNull($this->getData(), $field);
	}

	/**
	 * existsField 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function existsField($field)
	{
		return $this->getSchemaAccessor()->hasFieldAccessor($field);
	}

	/**
	 * clear 
	 * 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function clear($field)
	{
		return $this->getSchemaAccessor()->clear($this->getData(), $field);
	}

	/**
	 * getData 
	 * 
	 * @access public
	 * @return void
	 */
	public function getData()
	{
		return $this->data;
	}
    
    /**
     * getSchemaAccessor 
     * 
     * @access public
     * @return void
     */
    public function getSchemaAccessor()
    {
        return $this->schemaAccessor;
    }
    
    /**
     * setSchemaAccessor 
     * 
     * @param mixed $schemaAccessor 
     * @access public
     * @return void
     */
    public function setSchemaAccessor($schemaAccessor)
    {
        $this->schemaAccessor = $schemaAccessor;
        return $this;
    }

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $methodType 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($field, $accessType)
	{
		return $this->getSchemaAccess()->isSupportMethod($this->getData(), $field, $accessType);
	}

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldNames()
	{
		return $this->getSchemaAccessor()->getFieldNames();
	}

	/**
	 * getFieldValues 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldValues()
	{
		return $this->getSchemaAccessor()->getFieldValues($this->getData());
	}
}

