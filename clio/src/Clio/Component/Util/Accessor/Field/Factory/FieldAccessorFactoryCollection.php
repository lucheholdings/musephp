<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Pattern\Factory\NamedCollection as NamedFactoryCollection;
use Clio\Component\Util\Accessor\Field\FieldAccessorFactory;

use Clio\Component\Util\Accessor\Field;

/**
 * FieldAccessorFactoryCollection 
 * 
 * @uses NamedCollection
 * @uses FieldAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldAccessorFactoryCollection extends NamedFactoryCollection implements FieldAccessorFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor(Field $field, array $options = array())
	{
		$accessor = $namedAccessor = new Field\NamedCollection();
		foreach($this as $factory) {
			$fieldAccessor = $factory->createFieldAccessor($field, $options);

			if($fieldAccessor instanceof Field\SingleFieldAccessor) {
				$namedAccessor->set($fieldAccessor->getName(), $fieldAccessor);	
			} else if($fieldAccessor instanceof Field\MultiFieldAccessor) {
				if(!$accessor instanceof Field\ChainedFieldAccessor) {
					$accessor = new Field\ChainedFieldAccessor($accessor);
				}
				$accessor->addNext($fieldAccessor);
			}
		}

		return $accessor;
	}

	public function createFieldAccessorByType($type, Field $field, array $options = array())
	{
		return $this->createByKeyArgs($type, array($field, $options));
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedField(Field $field, array $options = array())
	{
		return $this->isSupportedArgs(array($field, $options));
	}

	public function isSupportedFieldType($type, Field $field, array $options = array())
	{
		if(!$this->has($type)) {
			throw new \Exception(sprintf('Unsupported Type "%s"', $type));
		}
		return $this->get($type)->isSupportedArgs(array($field, $options));
	}
}

