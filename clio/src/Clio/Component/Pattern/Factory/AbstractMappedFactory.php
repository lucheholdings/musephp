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
     * doCreate 
     * 
     * @param array $args 
     * @access protected
     * @return void
     */
    protected function doCreate(array $args)
    {
        return $this->doCreateByKey(array_shift($args), $args);
    }

    /**
     * doCreateByKey 
     * 
     * @param mixed $key 
     * @param array $args 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function doCreateByKey($key, array $args);

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

		return $this->doCreateByKey($key, $args);
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
		return $this->doCreateByKey($key, $args);
	}

    /**
     * canCreateArgs 
     * 
     * @param array $args 
     * @access public
     * @return void
     */
    public function canCreateArgs(array $args = array())
    {
        return $this->canCreateByKey(array_shift($args), $args);
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
		return true;
	}
}

