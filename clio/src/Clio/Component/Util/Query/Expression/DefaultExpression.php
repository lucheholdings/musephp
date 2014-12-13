<?php
namespace Clio\Component\Util\Query\Expression;

use Clio\Component\Util\Query\Literal\DefaultLiteral;
use Clio\Component\Util\Query\Operators;

use Clio\Component\Util\Query\Condition\ComparisonalCondition,
	Clio\Component\Util\Query\Condition\CollectionalCondition;
/**
 * DefaultExpression 
 *   Default Expression rules to parse and generate. 
 * 
 * @uses ExpressionInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DefaultExpression implements Expression 
{
	/**
	 * match 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function match($value)
    {
		return new ComparisonalCondition($value, ComparisonalCondition::OPERATOR_MATCH);
    }

	/**
	 * eq 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function eq($value)
    {
		return new ComparisonalCondition($value, ComparisonalCondition::OPERATOR_EQ);
    }

	/**
	 * ne 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function ne($value)
    {
		return new ComparisonalCondition($value, ComparisonalCondition::OPERATOR_NE);
    }

	/**
	 * gt 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function gt($value)
    {
		return new ComparisonalCondition($value, ComparisonalCondition::OPERATOR_GT);
    }

	/**
	 * ge 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function ge($value)
    {
		return new ComparisonalCondition($value, ComparisonalCondition::OPERATOR_GE);
    }

	/**
	 * lt 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function lt($value)
    {
		return new ComparisonalCondition($value, ComparisonalCondition::OPERATOR_LT);
    }

	/**
	 * le 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function le($value)
    {
		return new ComparisonalCondition($value, ComparisonalCondition::OPERATOR_LE);
    }

	/**
	 * isNull 
	 * 
	 * @access public
	 * @return void
	 */
	public function isNull()
    {
		return new ComparisonalCondition(null, ComparisonalCondition::OPERATOR_EQ, ComparisonalCondition::VALUE_IS_NULL);
    }

	/**
	 * isAny 
	 * 
	 * @access public
	 * @return void
	 */
	public function isAny()
    {
		return new ComparisonalCondition(null, ComparisonalCondition::OPERATOR_EQ, ComparisonalCondition::VALUE_IS_ANY);
    } 

	public function in(array $values)
	{
		return new ComparisonalCondition($values, ComparisonalCondition::OPERATOR_IN);
	}

	public function orx()
	{
		return new CollectionalCondition(func_get_args(), CollectionalCondition::OPERATOR_OR);
	}

	public function andx()
	{
		return new CollectionalCondition(func_get_args(), CollectionalCondition::OPERATOR_AND);
	}
}

