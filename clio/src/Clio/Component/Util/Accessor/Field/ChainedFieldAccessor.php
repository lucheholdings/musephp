<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * ChainedFieldAccessor 
 * 
 * @uses ProxyMultiFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ChainedFieldAccessor extends ProxyMultiFieldAccessor 
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
	 * @param MultiFieldAccessor $source 
	 * @param MultiFieldAccessor $next 
	 * @access public
	 * @return void
	 */
	public function __construct(MultiFieldAccessor $source, MultiFieldAccessor $next)
	{
		parent::__construct($source);

		$this->nextAccessor = $next;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get($container, $field)
	{
		if($this->getAccessor()->isSupportMethod($container, $field, self::ACCESS_GET)) {
			return $this->getAccessor()->get($container, $field);
		} else {
			return $this->next()->get($container, $field);
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function set($container, $field, $value)
	{
		if($this->getAccessor()->isSupportMethod($container, $field, self::ACCESS_SET)) {
			$this->getAccessor()->set($container, $field, $value);
		} else {
			$this->next()->set($container, $field, $value);
		}
		return $this;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function isNull($container, $field)
	{
		if($this->getAccessor()->isSupportMethod($container, $field, self::ACCESS_GET)) {
			return !((bool)$this->getAccessor()->get($container, $field));
		} else {
			return $this->next()->isNull($container, $field);
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function clear($container, $field)
	{
		if($this->getAccessor()->isSupportMethod($container, $field, self::ACCESS_SET)) {
			$this->getAccessor()->clear($container, $field);
		} 
		if($this->next()){
			$this->next()->clear($container, $field);
		}
		return $this;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function isSupportMethod($container, $field, $accessType)
	{
		if($this->getAccessor()->isSupportMethod($container, $field, $accessType)) {
			return true;
		}
		return $this->next()->isSupportMethod($container, $field, $accessType);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function existsField($container, $field)
	{
		if($this->getAccessor()->existsField($container, $field)) {
			return true;		
		}
		
		return $this->next()->existsField($container, $field);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldNames($container = null)
	{
		$fields = $this->next()->getFieldNames($container);

		return array_merge(
			$fields,
			$this->getAccessor()->getFieldNames($container)
		);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldValues($container)
	{
		$fields = $this->next()->getFieldValues($container);

		return array_replace(
			$fields,
			$this->getAccessor()->getFieldValues($container)
		);
	}
    
    /**
     * getNextAccessor 
     * 
     * @access public
     * @return void
     */
    public function next()
    {
		if(!$this->nextAccessor) {
			throw new \OutOfRangeException('ChainedMultiFieldAccessor not point any for next.');
		}
        return $this->nextAccessor;
    }
    
    /**
     * setNextAccessor 
     * 
     * @param MultiFieldAccessor $nextAccessor 
     * @access public
     * @return void
     */
    public function addNext(MultiFieldAccessor $nextAccessor)
    {
		if($this->nextAccessor && ($this->nextAccessor instanceof ChainedFieldAccessor)) {
			$this->nextAccessor->addNext($nextAccessor);
		} else {
			$this->nextAccessor = new ChainedFieldAccessor($this->nextAccessor, $nextAccessor);
		}
        return $this;
    }
}

