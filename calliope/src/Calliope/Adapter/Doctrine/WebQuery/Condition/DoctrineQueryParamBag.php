<?php
namespace Calliope\Adapter\Doctrine\WebQuery\Condition;

use Clio\Component\Util\Container\Map\Map;
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
class DoctrineQueryParamBag extends Map
{
	public function add($value)
	{
		$paramKey = 'param_' . HashUtil::generateHash(8);

		$this->set($paramKey, $value);

		return $paramKey;
	}
}

