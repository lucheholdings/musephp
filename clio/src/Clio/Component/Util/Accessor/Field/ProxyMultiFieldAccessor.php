<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * ProxyMultiFieldAccessor
 * 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxyMultiFieldAccessor implements MultiFieldAccessor
{
	/**
	 * accessor 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $accessor;

	/**
	 * __construct 
	 * 
	 * @param MultiFieldAccessor $accessor 
	 * @access public
	 * @return void
	 */
	public function __construct(MultiFieldAccessor $accessor)
	{
		$this->accessor = $accessor;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function get($container, $field)
	{
		return $this->getAccessor()->get($container, $field);
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function set($container, $field, $value)
	{
		$this->getAccessor()->set($container, $field, $value);
		return $this;
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function isNull($container, $field)
	{
		return $this->getAccessor()->isNull($container, $field);
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function clear($container, $field)
	{
		$this->getAccessor()->clear($container, $field);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function isSupportMethod($container, $field, $methodType)
	{
		return $this->getAccessor()->isSupportMethod($container, $field, $methodType);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldNames($container = null)
	{
		return $this->getAccessor()->getFieldNames($container);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldValues($container)
	{
		return $this->getAccessor()->getFieldValues($container);
	}

	/**
	 * {@inheritdoc}
	 */
	public function existsField($container, $field)
	{
		return $this->getAccessor()->existsField($container, $field);
	}
    
    /**
     * getAccessor 
     * 
     * @access public
     * @return void
     */
    public function getAccessor()
    {
        return $this->accessor;
    }

	/**
	 * setAccessor 
	 * 
	 * @param MultiFieldAccessor $accessor 
	 * @access public
	 * @return void
	 */
	public function setAccessor(MultiFieldAccessor $accessor)
	{
		$this->accessor = $accessor;
	}
}

