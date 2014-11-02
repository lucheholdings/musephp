<?php
namespace Clio\Component\Util\Accessor\Field;

/**
 * FieldAccessorCollection 
 * 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorCollection implements MultiFieldAccessor 
{

	/**
	 * {@inheritdoc}
	 */
	private $accessors = array();
	
	/**
	 * {@inheritdoc}
	 */
	public function __construct(array $accessors = array())
	{
		foreach($accessors as $field => $accessor) {
			$this->addFieldAccessor($accessor);
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function get($container, $field)
	{
		return $this->getFieldAccessor($field)->get($container);
	}
		
	/**
	 * {@inheritdoc}
	 */
	public function set($container, $field, $value)
	{
		$this->getFieldAccessor($field)->set($container, $value);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isNull($container, $field)
	{
		return $this->getFieldAccessor($field)->isNull($container);
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function clear($container, $field)
	{
		$container->getFieldAccessor($field)->clear($container);
		return $this;
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function isSupportMethod($container, $field, $type)
	{
		try {
			$accessor = $this->getFieldAccessor($field);
			return $accessor->isSupportMethod($container, $type);
		} catch(\Exception $ex) {
			// Field not exists, so not supported.
			return false;
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFieldValues($container)
	{
		$values = array();

		foreach($this->accessors as $field => $accessor) {
			if($accessor instanceof IgnoreFieldAccessor)
				continue;
			$values[$field] = $accessor->get($container);
		}

		return $values;
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldNames($container = null)
	{
		return array_keys(array_filter($this->accessors, function($accessor){
			if($accessor instanceof IgnoreFieldAccessor) {
				return false;
			}
			return true;
		}));
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function existsField($container, $field)
	{
		return $this->hasFieldAccessor($field) && !$this->isNull($container, $field);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function addFieldAccessor(SingleFieldAccessor $accessor)
	{
		$this->accessors[$accessor->getFieldName()] = $accessor;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasFieldAccessor($field)
	{
		return isset($this->accessors[$field]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldAccessor($field)
	{
		if(!isset($this->accessors[$field])) {
			throw new \RuntimeException(sprintf('Field "%s" is not supported.', $field));
		}

		return $this->accessors[$field];
	}
}
