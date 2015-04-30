<?php
namespace Clio\Component\Pattern\Factory;

/**
 * AbstractMappedFactory 
 * 
 * @uses AbstractFactory
 * @uses MappedFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMappedFactory extends AbstractFactory implements MappedFactory
{
    /**
     * {@inheritdoc}
     */
	public function createByKey($key)
    {
        return $this->doCreate(func_get_args());
    }
}

