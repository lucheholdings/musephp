<?php
namespace Clio\Component\Util\FieldAccessor;

/**
 * ProxyFieldAccessor 
 * 
 * @uses FieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyFieldAccessor implements FieldAccessor 
{
	/**
	 * accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessor;

	public function __construct(FieldAccessor $accessor)
	{
		$this->accessor = $accessor;
	}

	/**
	 * get 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($object, $field)
    {
		return $this->getAccessor()->get($object, $field);
    }

	/**
	 * set 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($object, $field, $value)
    {
		return $this->getAccessor()->set($object, $field, $value);
    }

	/**
	 * isNull
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isNull($object, $field)
    {
		return $this->getAccessor()->isNull($object, $field);
    }

	/**
	 * clear 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function clear($object, $field)
    {
		return $this->getAccessor()->clear($object, $field);
    }

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $methodType 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($object, $field, $methodType)
    {
		return $this->getAccessor()->isSupportMethod($object, $field, $methodType);
    }
    
    /**
     * Get accessor.
     *
     * @access public
     * @return accessor
     */
    public function getAccessor()
    {
        return $this->accessor;
    }
    
    /**
     * Set accessor.
     *
     * @access public
     * @param accessor the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setAccessor($accessor)
    {
        $this->accessor = $accessor;
        return $this;
    }

	/**
	 * getFields 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getFields($object)
	{
		return $this->getAccessor()->getFields($object);
	}

	/**
	 * getFieldNames 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($object = null)
	{
		return $this->getAccessor()->getFieldNames($object);
	}
}

