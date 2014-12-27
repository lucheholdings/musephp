<?php
namespace Clio\Component\Util\Accessor\Field\Factory;

use Clio\Component\Util\Accessor\Field;
use Clio\Component\Util\Accessor\Field\IgnoreFieldAccessor;

/**
 * IgnoreFieldAccessorFactory 
 * 
 * @uses AbstractFieldAccessorFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class IgnoreFieldAccessorFactory extends AbstractFieldAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createFieldAccessor(Field $field, array $options = array())
	{
		return new IgnoreFieldAccessor($field->getAlias());
	}

	public function isSupportedField(Field $field)
	{
		return true;
	}
}

