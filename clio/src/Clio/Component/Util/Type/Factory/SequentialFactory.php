<?php
namespace Clio\Component\Util\Type\Factory;

use Clio\Component\Util\Type\Factory;
use Clio\Component\Pattern\Factory\Exception\UnsupportedException;
use Clio\Component\Pattern\Factory\SequentialFactory as BaseFactory;
use Clio\Component\Pattern\Factory\Tool\FactoryTool;

/**
 * SequentialFactory 
 * 
 * @uses BaseFactory
 * @uses Factory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SequentialFactory extends BaseFactory implements Factory 
{
	/**
	 * createType 
	 * 
	 * @param mixed $name 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createType($name, array $options = array())
	{
		return parent::createArgs(array('key' => $name, 'options' => $options));
	}

	public function isSupportedArgs(array $args)
	{
		$key = FactoryTool::shiftArg($args, 'key');

		return $this->isSupportedType($key);
	}

	/**
	 * isSupportedType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function isSupportedType($type)
	{
		foreach($this as $factory) {
			if($factory->isSupportedType($type)) {
				return true;	
			}
		}
		return false;
	}
}
