<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Container\Set\PrioritySet;
use Clio\Component\Util\Validator\SubclassValidator;
/**
 * PriorityCollection 
 *   FieldAccessorCollection with PrioritySet 
 * 
 * @uses BaseCollection
 * @uses MultiFieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PriorityCollection extends AbstractCollection implements MultiFieldAccessor 
{
	protected function initContainer(array $accessors) 
	{
		$container = new PrioritySet();
		$container->setValueValidator(new SubclassValidator('Clio\Component\Util\Accessor\FieldAccessor'));

		foreach($accessors as $priority => $priAccessors) {
			foreach($priAccessors as $accessor) {
				$container->add($accessor, $priority);
			}
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

		}

		return $values;
	}

	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldNames($container = null)
	{
		return $this->getAccessors()->filter(function($accessor){
			if($accessor instanceof IgnoreFieldAccessor) {
				return false;
			}
			return true;
		})->getKeys();
	}

	/**
	 * {@inheritdoc}
	 */
	public function addFieldAccessor(FieldAccessor $accessor, $priority = 0)
	{
		$this->getAccessors()->add($accessor, $priority);

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasFieldAccessor($field)
	{
		try {
			return (bool)$this->getFieldAccessor($field);
		} catch(\InvalidArgumentException $ex) {
			return false;
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getFieldAccessor($field)
	{
		foreach($this->getAccessors()->getValuesOrdered() as $accessor) {
			if($accessor instanceof MultiFieldAccessor) { 
				if($accessor->hasFieldAccessor($field)) {
					return $accessor;
				}
			} else if($accessor instanceof SingleFieldAccessor) {
				if($field === $accessor->getFieldName()) {
					return $accessor;
				}
			}
		}
		
		throw new \InvalidArgumentException(sprintf('Field "%s" is not eixsts.', $field));
	}
}

