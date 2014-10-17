<?php
namespace Clio\Component\Util\Accessor;

/**
 * ObjectAccessor 
 * 
 * @uses Accessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ObjectAccessor implements Accessor 
{
	/**
	 * schemaAccessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $schemaAccessor;

	/**
	 * __construct 
	 * 
	 * @param ClassAccessor $schemaAccessor 
	 * @param object $object 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassAccessor $schemaAccessor, object $object)
	{
		$this->schemaAccessor = $schemaAccessor;
		$this->object = $object;
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
		return $this->getSchemaAccessor()->get($field);
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
		return $this->getSchemaAccessor()->get($this->getData, $field, $value);
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
		return $this->object;
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
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getFieldValues()
	{
		return $this->getSchemaAccessor()->getFieldValues($this->getData());
	}
}

