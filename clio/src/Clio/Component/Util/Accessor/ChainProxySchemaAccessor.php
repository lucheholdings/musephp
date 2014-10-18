<?php
namespace Clio\Component\Util\Accessor;

/**
 * ChainProxySchemaAccessor 
 *   Chain-of-responsibility with SchemaAccessor.
 *   Make sure you call isSupportMethod before call get, set, isNull, clear
 *   or the end of Chain is not chained.
 *   Otherwise, it might throw an OutOfRangeException. 
 * 
 *   $accessor = new ChainProxySchemaAccessor($decorateAccessor, $accessor);
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ChainProxySchemaAccessor implements SchemaAccessor
{
	/**
	 * sourceAccessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $sourceAccessor;

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
	public function __construct(SchemaAccessor $sourceAccessor, SchemaAccessor $nextAccessor)
	{
		$this->sourceAccessor = $sourceAccessor;
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
		if($this->getSourceAccessor()->isSupportMethod($container, $field, self::ACCESS_GET)) {
			return $this->getSourceAccessor()->get($container, $field);
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
		if($this->getSourceAccessor()->isSupportMethod($container, $field, self::ACCESS_SET) {
			$this->getSourceAccessor()->set($container, $field, $value);
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
		if($this->getSourceAccessor()->isSupportMethod($container, $field, self::ACCESS_GET) {
			return $this->getSourceAccessor()->set($container, $field);
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
		if($this->getSourceAccessor()->isSupportMethod($container, $field, self::ACCESS_SET) {
			$this->getSourceAccessor()->clear($container, $field);
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
		if($this->getSourceAccessor()->isSupportMethod($container, $field, $accessType)) {
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
			$this->getSourceAccessor()->getFieldNames($container)
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
			$this->getSourceAccessor()->getFieldValues($container)
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
    
    /**
     * getSourceAccessor 
     * 
     * @access public
     * @return void
     */
    public function getSourceAccessor()
    {
        return $this->sourceAccessor;
    }
    
    /**
     * setSourceAccessor 
     * 
     * @param mixed $sourceAccessor 
     * @access public
     * @return void
     */
    public function setSourceAccessor($sourceAccessor)
    {
        $this->sourceAccessor = $sourceAccessor;
        return $this;
    }
}

