<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Util\Type\Factory;
use Clio\Component\Pattern\Factory\PriorityMappedFactoryCollection;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;

/**
 * TypeFactoryCollection 
 * 
 * @uses PriorityMappedFactoryCollection
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeFactoryCollection extends PriorityMappedFactoryCollection implements Factory 
{
    /**
     * getFactoryClass 
     * 
     * @access protected
     * @return void
     */
    protected function getFactoryClass()
    {
        return 'Clio\Component\Util\Type\Factory';
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
        return $this->createByKeyArgs($type, array('options' => $options));
    }

    /**
     * canCreateByType 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function canCreateByType($type, array $options = array())
    {
        return $this->canCreateByKey($type, array('options' => $options));
    }
}

