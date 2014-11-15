<?php
namespace Clio\Component\Tool\Normalizer\Strategy;

/**
 * InterfaceStrategy 
 *   InterfaceStrategy is an alias of SubclassStrategy
 * 
 * @uses ObjectStrategy
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class InterfaceStrategy extends SubclassStrategy 
{
	protected function getClassName()
	{
		return $this->getInterfaceName();		
	}

	abstract protected function getInterfaceName();
}

