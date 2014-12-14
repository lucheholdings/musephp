<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;

use Clio\Bridge\SymfonyComponents\Registry\AliasContainerRegistry;

class ListenerFactoryRegistry extends AliasContainerRegistry
{
	/**
	 * createFilterListener 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createFilterListener($type, array $options = array())
	{
		return $this->get($type)->createFilterListener($options);
	}
}

