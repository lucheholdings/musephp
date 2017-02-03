<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Framework\Kvs;

use Clio\Framework\Registry\AliasServiceRegistry;

use Clio\Component\Util\Container\Map;

/**
 * KvsRegistry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class KvsRegistry extends AliasServiceRegistry 
{
	/**
	 * {@inheritdoc}
	 */
	protected function isValidService($service)
	{
		return ($service instanceof Map);
	}
}

