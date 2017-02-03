<?php
namespace Clio\Component\Util\FieldAccessor;

/**
 * ChainFieldAccessor 
 * 
 * @uses ProxyFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ChainFieldAccessor extends ProxyFieldAccessor 
{
	/**
	 * chainedAccessor
	 * 
	 * @var mixed
	 * @access private
	 */
	private $chainedAccessor;

	/**
	 * isSupportMethod 
	 * 
	 * @param mixed $object 
	 * @param mixed $field 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportMethod($object, $field, $type)
	{
		if($this->getAccessor()->isSupportMethod($obj, $field, $type)) {
			return true;
		}

		return $this->getChainedAccessor()->isSupportMethod($obj, $field, $type);
	}

    /**
     * Get chainedAccessor.
     *
     * @access public
     * @return chainedAccessor
     */
    public function getChainedAccessor()
    {
        return $this->chainedAccessor;
    }
    
    /**
     * Set chainedAccessor.
     *
     * @access public
     * @param chainedAccessor the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setChainedAccessor(FieldAccessor $chainedAccessor)
    {
        $this->chainedAccessor = $chainedAccessor;
        return $this;
    }

	/**
	 * hasChainedAccessor 
	 * 
	 * @access public
	 * @return void
	 */
	public function hasChainedAccessor()
	{
		return (bool) $this->chainedAccessor;
	}

	/**
	 * set 
	 * 
	 * @param mixed $obj 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($obj, $field, $value)
	{
		if(parent::isSupportMethod($obj, $field, self::METHOD_TYPE_SET)) {
			return parent::set($obj, $field, $value);
		} else if($this->hasChainedAccessor()) {
			return $this->getChainedAccessor()->set($obj, $field, $value);
		}

		throw new \Clio\Component\Exception\RuntimeException(sprintf('Field "%s" is not supported.', $field));
	}

	/**
	 * get 
	 * 
	 * @param mixed $obj 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function get($obj, $field)
	{
		if($this->getAccessor()->isSupportMethod($obj, $field, self::METHOD_TYPE_SET)) {
			return parent::get($obj, $field);
		} else if($this->hasChainedAccessor()) {
			return $this->getChainedAccessor()->get($obj, $field);
		}

		throw new \Clio\Component\Exception\RuntimeException(sprintf('Field "%s" is not supported.', $field));
	}

	/**
	 * clear 
	 * 
	 * @param mixed $obj 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function clear($obj, $field)
	{

		if($this->getAccessor()->isSupportMethod($obj, $field, self::METHOD_TYPE_CLEAR)) {
			return parent::clear($obj, $field);
		} else if($this->hasChainedAccessor()){
			return $this->getChainedAccessor()->clear($obj, $field);
		}

		throw new \Clio\Component\Exception\RuntimeException(sprintf('Field "%s" is not supported.', $field));
	}

	/**
	 * isNull 
	 * 
	 * @param mixed $obj 
	 * @param mixed $field 
	 * @access public
	 * @return void
	 */
	public function isNull($obj, $field)
	{
		if($this->getAccessor()->isSupportMethod($obj, $field, self::METHOD_TYPE_IS_NULL)) {
			return parent::isNull($obj, $field);
		} else if($this->hasChainedAccessor()) {
			return $this->getChainedAccessor()->isNull($obj, $field);
		}

		throw new \Clio\Component\Exception\RuntimeException(sprintf('Field "%s" is not supported.', $field));
	}

	/**
	 * getProperitesOf 
	 * 
	 * @param mixed $object 
	 * @access public
	 * @return void
	 */
	public function getFields($object)
	{
		$fields = $this->getAccessor()->getFields($object);

		if($this->hasChainedAccessor()) {
			$fields = array_merge($this->getChainedAccessor()->getFields($object), $fields); 
		}

		return $fields;
	}

	/**
	 * getFieldNames 
	 * 
	 * @access public
	 * @return void
	 */
	public function getFieldNames($object = null)
	{
		$properties = $this->getAccessor()->getFieldNames($object);

		if($this->hasChainedAccessor()) {
			$properties = array_unique(array_merge($this->getChainedAccessor()->getFieldNames($object), $properties));
		}

		return $properties;
	}

	/**
	 * addChain 
	 *   Add Accessor on the end of chain 
	 * @param FieldAccessor $accessor 
	 * @access public
	 * @return void
	 */
	public function addChain(FieldAccessor $accessor)
	{
		if($accessor) {
			if($this->chainedAccessor) {
				$accessor = $this->chainedAccessor->addChain($accessor);
			} else {
				$accessor = $this->chainedAccessor = new ChainFieldAccessor($accessor);
			}
		}

		return $accessor;
	}
}

