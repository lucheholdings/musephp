<?php
namespace Clio\Component\Util\Accessor\Factory;

/**
 * ArrayAccessorFactory 
 * 
 * @uses AbstractAccessorFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ArrayAccessorFactory extends AbstractAccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function createAccessor($data, array $options = array())
	{
		return new ArrayAccessor($data);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function isSupportedData($data)
	{
		return is_array($data);
	}
}

