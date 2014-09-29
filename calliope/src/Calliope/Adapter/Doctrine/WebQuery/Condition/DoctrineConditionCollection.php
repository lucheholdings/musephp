<?php
namespace Calliope\Adapter\Doctrine\WebQuery\Condition;

use Clio\Component\Util\Container\Collection\Collection;
use Doctrine\ORM\QueryBuilder;
/**
 * DoctrineConditionCollection 
 * 
 * @uses Collection
 * @uses DoctrineConditionInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineConditionCollection extends Collection implements DoctrineConditionInterface
{
	public function applyToQueryBuilder(QueryBuilder $qb)
	{
		foreach($this as $cond) {
			$cond->applyToQueryBuilder($qb);
		}
	}
}

