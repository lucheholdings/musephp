<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Accessor\FieldAccessor;
use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Validator\SubclassValidator;
/**
 * NamedCollection 
 *   FieldAccessorCollection with Map (KeyValue) 
 * 
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class NamedCollection extends AbstractCollection 
{
	/**
	 * {@inheritdoc}
	 */
	protected function initContainer(array $accessors = array())
	{
		// Simple Collection
		$container = new Map();
		$container->enableStorageValidation();
		$container->getStorage()->setValueValidator(new SubclassValidator('Clio\Component\Util\Accessor\FieldAccessor'));

		foreach($accessors as $field => $accessor) {
			$container->set($field, $accessor);
		}

		$this->setAccessors($container);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFieldValues($container)
	{
		$values = array();

		foreach($this->getAccessors() as $field => $accessor) {
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
		$filtered = array_filter($this->getAccessors()->toArray(), function($accessor){
			if($accessor instanceof IgnoreFieldAccessor) {
				return false;
			}
			return true;
		});
		return array_keys($filtered);
	}

	/**
	 * {@inheritdoc}
	 */
	public function addFieldAccessor(FieldAccessor $accessor)
	{
		$accessors = $this->getAccessors();
		if($accessor instanceof SingleFieldAccessor) {
			$accessors[$accessor->getFieldName()] = $accessor;
		} else if($accessor instanceof MultiFieldAccessor) {
			foreach($accessor->getFieldNames() as $fieldname) {
				$accessors[$fieldname] = $accessor;
			}
		}

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasFieldAccessor($field)
	{
		return $this->getAccessors()->has($field);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldAccessor($field)
	{
		if(!$this->getAccessors()->has($field)) {
			throw new \RuntimeException(sprintf('Field "%s" is not supported.', $field));
		}

		return $this->getAccessors()->get($field);
	}
}
