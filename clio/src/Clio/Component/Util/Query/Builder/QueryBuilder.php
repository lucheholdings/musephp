<?php
namespace Clio\Component\Util\Query\Builder;

use Clio\Component\Util\Query\Expression\DefaultExpression;
use Clio\Component\Util\Query\LiteralSet;
use Clio\Component\Util\Query\Condition\FieldCondition,
	Clio\Component\Util\Query\Condition\FieldValueCondition,
	Clio\Component\Util\Query\Condition\ComparisonalCondition,
	Clio\Component\Util\Query\Condition\CollectionalCondition
;


/**
 * QueryBuilder 
 *   Builder to build from Conditioin to string
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class QueryBuilder
{
	private $fields = array();

	private $expr;

	private $literals;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(LiteralSet $literals)
	{
		$this->expr = new DefaultExpression();
		$this->literals = $literals;
	}

	public function expr()
	{
		return $this->expr;
	}

	public function add(FieldCondition $condition) 
	{
		$this->fields[$condition->getField()] = $condition;
	}

	public function build()
	{
		$queries = array();
		// 
		foreach($this->fields as $cond) {
			$query = $this->buildQuery($cond->getValueCondition());
			if($query && !empty($query)) {
				$queries[$cond->getField()] = $query;
			}
		}

		return $queries;
	}

	public function buildQuery(FieldValueCondition $condition)
	{
		$query = '';
		if($condition instanceof CollectionalCondition) {
			$operator = $condition->getOperator();
			if(CollectionalCondition::OPERATOR_AND == $operator) {
				// 
				$query .= $this->literals->operatorAnd();
			}
			$query .= $this->literals->collectionOpen();
			$comparisons = array();
			foreach($condition->getConditions() as $innerCondition) {
				$comparison = $this->buildQuery($innerCondition);
				if($comparison) {
					$comparisons[] = $comparison;
				}
			}
			// if empty collection then retun null.
			if(empty($comparisons)) {
				return null;
			}
			$query .= implode($comparisons, $this->literals->collectionSeparator());
			$query .= $this->literals->collectionClose();
		} else if($condition instanceof ComparisonalCondition){
			$query = $this->doBuildComparisonalCondition($condition);
		}

		return $query;
	}

	protected function doBuildComparisonalCondition(ComparisonalCondition $condition)
	{
		//$condition->getOperator()
		switch($condition->getOperator()) {
		case ComparisonalCondition::OPERATOR_EQ:
			if($condition->isValueNull()) {
				$query = $this->literals->operatorEq() .  $this->literals->valueNull();
			} else  if($condition->isValueAny()) {
				$query = $this->literals->operatorEq() . $this->literals->valueAny();
			} else {
				$query = $this->literals->operatorEq() . $this->literals->encodeValue($condition->getValue());
			}
			break;
		case ComparisonalCondition::OPERATOR_NE:
			$query = $this->literals->operatorNe() . $this->literals->encodeValue($condition->getValue());
			break;
		case ComparisonalCondition::OPERATOR_GT:
			$query = $this->literals->operatorGt() . $this->literals->encodeValue($condition->getValue());
			break;
		case ComparisonalCondition::OPERATOR_GE:
			$query = $this->literals->operatorGe() . $this->literals->encodeValue($condition->getValue());
			break;
		case ComparisonalCondition::OPERATOR_LT:
			$query = $this->literals->operatorLt() . $this->literals->encodeValue($condition->getValue());
			break;
		case ComparisonalCondition::OPERATOR_LE:
			$query = $this->literals->operatorLe() . $this->literals->encodeValue($condition->getValue());
			break;
		case ComparisonalCondition::OPERATOR_MATCH:
			$query = $this->literals->operatorMatch() . $this->literals->encodeValue($condition->getValue());
			break;
		case ComparisonalCondition::OPERATOR_IN:
			$query = $this->literals->collectionOpen();
			$values = array();
			foreach($condition->getValue() as $value) {
				$values[] = $this->literals->operatorEq() . $this->literals->encodeValue($value);

			}
			$query .= implode($this->literals->collectionSeparator(), $values);
			$query .= $this->literals->collectionClose();
				
				;
			break;
		default:
			throw new \Exception(sprintf('Invalid Operator Condition "%s" is given.', $condition->getOperator()));
			break;
		}

		return $query;
	}
}

