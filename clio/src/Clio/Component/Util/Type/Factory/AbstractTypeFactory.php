<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Util\Type\Factory;

/**
 * AbstractTypeFactory 
 * 
 * @uses Factory
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractTypeFactory implements Factory
{

	public function createByKey()
	{
		$args = func_get_args();
		$key = array_shift($args);

		return $this->createByKeyArgs($key, $args); 
	}

	public function createByKeyArgs($key, array $args = array())
	{
		return $this->createType($key);
	}

	public function isSupportedKeyArgs($key, array $args = array())
	{
		return true;
		throw new \RuntimeException('not supported');
	}
}

