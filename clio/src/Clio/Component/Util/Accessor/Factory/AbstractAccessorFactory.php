<?php
namespace Clio\Component\Util\Accessor\Factory;

use Clio\Component\Util\Accessor\Factory\AccessorFactory;

/**
 * AbstractAccessorFactory 
 * 
 * @uses AccessorFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractAccessorFactory implements AccessorFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function doCreate(array $args)
	{
		$data = array_shift($args);
		$options = array_shift($args) ?: array();
		return $this->createAccessor($data, $options)
	}

	/**
	 * isSupportedData 
	 * 
	 * @param mixed $data 
	 * @abstract
	 * @access protected
	 * @return void
	 */
	abstract protected function isSupportedData($data);

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedFactory(array $args)
	{
		return $this->isSupportedData(array_shift($args));
	}
}
