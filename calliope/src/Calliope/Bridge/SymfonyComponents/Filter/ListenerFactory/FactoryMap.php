<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;

use Clio\Component\Pattern\Factory\NamedCollection as BaseFactoryMap;

/**
 * FactoryMap 
 * 
 * @uses BaseFactoryMap
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class FactoryMap extends BaseFactoryMap 
{
	
	
	/**
	 * createFilterListener 
	 * 
	 * @param mixed $type 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createFilterListener($type, array $args = array())
	{
		return parent::createByKeyArgs($type, $args);
	}
}

