<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;

use Clio\Component\Pattern\Factory\ClassFactory as BaseFactory;

/**
 * ListenerFactoryClassFactory 
 *   This is a FactoryFactory of FilterListener.
 *   
 * @uses BaseFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ListenerFactoryClassFactory extends BaseFactory 
{
	public function createFilterListenerFactory($class, array $options = array())
	{
		$filterListener = parent::createClassArgs($class);
		$filterListener->setOptions($options);

		return $filterListener;
	}
}

