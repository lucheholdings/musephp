<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Framework\Counter;

use Clio\Framework\Registry\AliasServiceRegistry;

use Clio\Component\Tool\Counter\Counter;

/**
 * CounterRegistry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CounterRegistry extends AliasServiceRegistry 
{
	/**
	 * {@inheritdoc}
	 */
	protected function isValidService($service)
	{
		return ($service instanceof Counter);
	}
}

