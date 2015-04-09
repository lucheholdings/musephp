<?php
namespace Clio\Component\Pattern\Factory;

/**
 * PriorityMappedFactoryCollection 
 * 
 * @uses PriorityFactoryCollection
 * @uses MappedFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class PriorityMappedFactoryCollection extends PriorityFactoryCollection implements MappedFactory
{
    /**
     * getFactoryClass 
     * 
     * @access protected
     * @return void
     */
    protected function getFactoryClass()
    {
        return 'Clio\Component\Pattern\Factory\MappedFactory';
    }

    /**
     * createArgs 
     * 
     * @param array $args 
     * @access public
     * @return void
     */
    public function createArgs(array $args = array())
    {
        $key = Tool\FactoryTool::shiftArg($args, 'key');
        return $this->createByKeyArgs($key, $args);
    }

    /**
     * createByKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function createByKey($key)
    {
        $args = func_get_args();
        array_shift($args);

        return $this->createByKeyArgs($key, $args);
    }

    /**
     * createByKeyArgs 
     * 
     * @param mixed $key 
     * @param array $args 
     * @access public
     * @return void
     */
    public function createByKeyArgs($key, array $args = array())
    {
		foreach($this as $factory) {
			if($factory->canCreateByKey($key, $args)) {
				return $factory->createByKeyArgs($key, $args);
			}
		}
        throw new UnsupportedException(sprintf('Key "%s" is not supported.', $key));
    }

    /**
     * canCreate 
     * 
     * @param array $args 
     * @access public
     * @return void
     */
    public function canCreate(array $args = array())
    {
        $key = array_shift($args);
        return $this->canCreateByKey($key, $args);
    }

    /**
     * canCreateByKey 
     * 
     * @param mixed $key 
     * @param array $args 
     * @access public
     * @return void
     */
    public function canCreateByKey($key, array $args = array())
    {
		foreach($this as $factory) {
			if($factory->canCreateByKey($key, $args)) {
                return true;
			}
		}
        return false;
    }
}

