<?php
namespace Calliope\Adapter\Doctrine\WebQuery\Condition\Resolver;

/**
 * ConditionResolver 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ConditionResolver
{
	/**
	 * resolveCondition 
	 * 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @param mixed $parentAlias 
	 * @access public
	 * @return void
	 */
	function resolveCondition($field, $value, $parentAlias = null);
}

