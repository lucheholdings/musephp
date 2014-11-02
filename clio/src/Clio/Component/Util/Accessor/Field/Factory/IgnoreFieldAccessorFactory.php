<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Accessor\Field\IgnoreFieldAccessor;

class IgnoreFieldAccessorFactory extends AbstractFieldAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor(Field $field, array $options = array())
	{
		return new IgnoreFieldAccessor($field->getName());
	}

	public function isSupportedField(Field $field)
	{
		return true;
	}
}

