<?php
namespace Clio\Component\Pattern\Factory;

use Clio\Component\Container\ArrayImpl\Collection;

/**
 * SequentialMappedFactory 
 * 
 * @uses Collection
 * @uses MappedFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialMappedFactory extends Collection implements MappedFactory 
{
    /**
     * {@inheritdoc}
     */
	public function create()
	{
		return $this->createArgs(func_get_args());
	}

    /**
     * {@inheritdoc}
     */
	public function createArgs(array $args)
	{
		return $this->doCreate($args);
	}

    /**
     * {@inheritdoc}
     */
	public function createByKey($key)
	{
		return $this->createArgs(func_get_args());
	}

    /**
     * {@inheritdoc}
     */
	public function createByKeyArgs($key, array $args = array())
	{
		array_unshift($args, $key);
		return $this->doCreate($args);
	}

    /**
     * {@inheritdoc}
     */
	protected function doCreate(array $args)
	{
		foreach($this as $factory) {
			try {
				return $factory->createArgs($args);
			} catch(Exception $ex) {
                // Ignore factory exception
				continue;
			}
		}

		throw new Exception\UnsupportedException('Failed to create object.');
	}

    /**
     * {@inheritdoc}
     */
	public function addFactory(Factory $factory) 
	{
		$this->add($factory);
	}
}
