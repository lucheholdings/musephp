<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Util\Type\Factory;
use Clio\Component\Pattern\Factory\AbstractMappedFactory;
use Clio\Component\Pattern\Factory\Tool\FactoryTool;

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
abstract class AbstractTypeFactory extends AbstractMappedFactory implements Factory
{
    /**
     * doCreateByKey 
     * 
     * @param mixed $key 
     * @param array $args 
     * @access protected
     * @return void
     */
	protected function doCreateByKey($key, array $args)
	{
		$options = FactoryTool::shiftArg($args, 'options', array());

		return $this->createType($key, $options);
	}

    /**
     * canCreateByKey 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function canCreateByKey($key)
    {
        return $this->canCreateByType($key);
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
		return $this->isSupportedType($type);
	}

    /**
     * isSupportedType 
     * 
     * @param mixed $type 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function isSupportedType($type);
}

