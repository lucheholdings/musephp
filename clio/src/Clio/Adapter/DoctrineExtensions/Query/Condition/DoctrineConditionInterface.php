<?php
namespace Clio\Adapter\DoctrineExtensions\Query\Condition;

use Doctrine\ORM\QueryBuilder;

/**
 * DoctrineConditionInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface DoctrineConditionInterface
{
	/**
	 * applyToQueryBuilder 
	 * 
	 * @param QueryBuilder $qb 
	 * @access public
	 * @return void
	 */
	function applyToQueryBuilder(QueryBuilder $qb);
}

