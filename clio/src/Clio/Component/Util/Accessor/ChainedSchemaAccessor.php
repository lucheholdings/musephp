<?php
namespace Clio\Component\Util\Accessor;

/**
 * ChainedSchemaAccessor 
 *   Chain-of-responsibility with SchemaAccessor.
 *   Make sure you call isSupportMethod before call get, set, isNull, clear
 *   or the end of Chain is not chained.
 *   Otherwise, it might throw an OutOfRangeException. 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ChainedSchemaAccessor extends  
{
	/**
	 * nextAccessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $nextAccessor;

	/**
	 * __construct 
	 * 
	 * @param array $accessors 
	 * @param SchemaAccessor $nextAccessor 
	 * @access public
	 * @return void
	 */
	public function __construct(array $accessors = array(), SchemaAccessor $nextAccessor = null)
	{
		$this->nextAccessor = $nextAccessor;
	}

	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($container, $field)
	{
		if(parent::isSupportMethod($container, $field, self::ACCESS_GET)) {
			return parent::get($container, $field);
		} else {
			return $this->getNextAccessor()->get($container, $field);
		}
	}

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($container, $field, $value)
	{
		if(parent::isSupportMethod($container, $field, self::ACCESS_SET) {
			parent::set($container, $field, $value);
		} else {
			$this->getNextAccessor()->set($container, $field, $value);
		}
		return $this;
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isNull($container, $field)
	{
		if(parent::isSupportMethod($container, $field, self::ACCESS_GET) {
			return parent::set($container, $field);
		} else {
			return $this->getNextAccessor()->isNull($container, $field);
		}
	}

	/**
	 * clear 
	 * 
	 * @param mixed $container 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function clear($container, $field)
	{
		if(parent::isSupportMethod($container, $field, self::ACCESS_SET) {
			parent::clear($container, $field);
		} else {
			$this->getNextAccessor()->clear($container, $field, $value);
		}
		return $this;
	}

	/**
	 * isSupportMethod 
	 * 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod()
	{
		if(parent::isSupportMethod($container, $field, $accessType)) {
			return true;
		} else if(!$this->hasNextAccessor()) {
			return $this->getNextAccessor()->isSupportMethod($container, $field, $accessType);
		}

		return false;
	}

	/**
	 * getFieldNames 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($container = null)
	{
		$fields = array();
		if($this->hasNextAccessor()) {
			$fields = $this->getNextAccessor()->getFieldNames();
		}

		return array_merge(
			$fields,
			parent::getFieldNames($container)
		)
	}

	/**
	 * getFieldValues 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	public function getFieldValues($container)
	{
		$fields = array();
		if($this->hasNextAccessor()) {
			$fields = $this->getNextAccessor()->getFieldValues($container);
		}

		return array_replace(
			$fields,
			parent::getFieldValues($container)
		);
	}

	/**
	 * hasNextAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasNextAccessor()
	{
		return null !== $this->nextAccessor;
	}
    
    /**
     * getNextAccessor 
     * 
     * @access public
     * @return void
     */
    public function getNextAccessor()
    {
		if(!$this->nextAccessor) {
			throw new \OutOfRangeException('Next Accessor is not exists.');
		}
        return $this->nextAccessor;
    }
    
    /**
     * setNextAccessor 
     * 
     * @param SchemaAccessor $nextAccessor 
     * @access public
     * @return void
     */
    public function setNextAccessor(SchemaAccessor $nextAccessor)
    {
        $this->nextAccessor = $nextAccessor;
        return $this;
    }
}

