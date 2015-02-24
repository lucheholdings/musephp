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
	public function doCreate(array $args = array())
	{
		$key = $this->shiftArg($args, 'key');
		$options = $this->shiftArg($args, 'options');

		return $this->createType($key, $options);
	}

	public function isSupportedArgs(array $args = array())
	{
		$key = FactoryTool::shiftArg($args, 'key');

		return $this->isSupportedType($key);
	}
}

