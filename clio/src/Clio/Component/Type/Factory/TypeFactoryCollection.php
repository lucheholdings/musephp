<?php
namespace Clio\Component\Type\Factory;

use Clio\Component\Type\Factory as FactoryInterface;
use Clio\Component\Pattern\Factory;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;

/**
 * TypeFactoryCollection 
 *   Create a type instance with factories
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeFactoryCollection extends Factory\SequentialMappedFactory implements FactoryInterface 
{
    /**
     * getFactoryClass 
     * 
     * @access protected
     * @return void
     */
    protected function getFactoryClass()
    {
        return 'Clio\Component\Type\Factory';
    }

    /**
     * createType 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function createType($type, array $options = array())
    {
        return $this->doCreate(array($type, $options));
    }
}

