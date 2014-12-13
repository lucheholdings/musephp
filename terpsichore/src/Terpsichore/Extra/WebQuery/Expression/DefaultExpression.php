<?php
namespace Terpsichore\Extra\WebQuery\Expression;

use Terpsichore\Extra\WebQuery\Literal\DefaultLiteral;
use Terpsichore\Extra\WebQuery\Operators;

use Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition,
	Terpsichore\Extra\WebQuery\Condition\CollectionalCondition;
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

