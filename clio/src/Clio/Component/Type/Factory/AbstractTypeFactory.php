<?php
namespace Clio\Component\Type\Factory;

use Clio\Component\Type\Factory as TypeFactory;
use Clio\Component\Pattern\Factory;

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
abstract class AbstractTypeFactory extends Factory\AbstractMappedFactory implements TypeFactory
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
		return $this->doCreateType(Factory\Util::shiftArg($args, 'type'), Factory\Util::shiftArg($args, 'options', array()));
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
        return $this->doCreateType($type, $options);
    }

    /**
     * doCreateType 
     * 
     * @param mixed $type 
     * @param array $options 
     * @abstract
     * @access protected
     * @return void
     */
    abstract protected function doCreateType($type, array $options);
}

