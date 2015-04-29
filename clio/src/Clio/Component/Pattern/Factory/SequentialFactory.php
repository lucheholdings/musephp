<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Pattern\Factory\Exception\UnsupportedExcpetion;
use Clio\Component\Container\Collection\SimpleCollection;
/**
 * SequentialFactory
 *    
 * @uses Collection
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialFactory extends SimpleCollection implements MappedFactory 
{
	public function create()
	{
		return $this->createArgs(func_get_args());
	}

	public function createArgs(array $args)
	{
		return $this->doCreate($args);
	}

	public function createByKey($key)
	{
		return $this->createArgs(func_get_args());
	}

	public function createByKeyArgs($key, array $args = array())
	{
		array_unshift($args, $key);
		return $this->doCreate($args);
	}

	protected function doCreate(array $args)
	{
		// 
		foreach($this as $factory) {
			try {
				return $factory->createArgs($args);
			} catch(UnsupportedException $ex) {
				continue;
			}
		}

		throw new UnsupportedException('Cannot create');
	}

	public function isSupportedKeyArgs($key, array $args = array())
	{
		array_unshift($args, $key);
		return $this->isSupportedArgs($args);
	}

	public function addFactory(Factory $factory) 
	{
		$this->add($factory);
	}
}
