<?php
namespace Clio\Component\Accessor\Field;

/**
 * Collection 
 *   Collection of SingleFieldAccessor 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Collection implements MultiFieldAccessor 
{
	/**
	 * {@inheritdoc}
	 */
	private $fields = array();
	
	/**
	 * {@inheritdoc}
	 */
	public function __construct(array $fields = array())
	{
		foreach($fields as $field => $accessor) {
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
	public function isSupportedAccess($container, $field, $type)
	{
		try {
			$field = $this->getFieldAccessor($field);
			return $field->isSupportedAccess($container, $type);
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

		foreach($this->fields as $field => $accessor) {
			if($accessor instanceof IgnoreFieldAccessor)
				continue;
            
			if($accessor->isSupportedAccess($container, self::ACCESS_TYPE_GET)) {
				$values[$field] = $accessor->get($container);
			}
		}

		return $values;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldNames($container = null)
	{
		return array_keys(array_filter($this->fields, function($field){
			if($field instanceof IgnoreFieldAccessor) {
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
		return $this->hasFieldAccessor($field);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function addFieldAccessor(SingleFieldAccessor $accessor)
	{
		$this->fields[$accessor->getFieldName()] = $accessor;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasFieldAccessor($field)
	{
		return isset($this->fields[$field]);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldAccessor($field)
	{
		if(!isset($this->fields[$field])) {
			throw new \RuntimeException(sprintf('Field "%s" is not supported.', $field));
		}

		return $this->fields[$field];
	}
}
