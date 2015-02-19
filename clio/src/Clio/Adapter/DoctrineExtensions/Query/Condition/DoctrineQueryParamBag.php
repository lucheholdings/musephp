<?php
namespace Clio\Adapter\DoctrineExtensions\Query\Condition;

use Clio\Component\Util\Container\Map\StorageMap;
use Clio\Component\Util\Hash\HashUtil;

/**
 * DoctrineQueryParamBag 
 * 
 * @uses Container
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineQueryParamBag extends StorageMap
{
	public function add($value)
	{
		$paramKey = 'param_' . HashUtil::generateHash(8);

		$this->set($paramKey, $value);

		return $paramKey;
	}
}

