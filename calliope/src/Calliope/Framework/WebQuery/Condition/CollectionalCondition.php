<?php
namespace Calliope\Framework\WebQuery\Condition;

use Calliope\Framework\WebQuery\Tokenizer;

/**
 * CollectionalCondition 
 * 
 * @uses FieldValueCondition
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class CollectionalCondition implements FieldValueCondition
{
	const OPERATOR_OR  = 1;
	const OPERATOR_AND = 2;

	/**
	 * operator 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $operator;

	/**
	 * conditions 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $conditions;

	/**
	 * __construct 
	 * 
	 * @param array $conditions 
	 * @param mixed $operator 
	 * @access public
	 * @return void
	 */
	public function __construct(array $conditions = array(), $operator = self::OPERATOR_OR)
	{
		$this->conditions = array();
		$this->setOperator($operator);
		
		foreach($conditions as $condition) {
			$this->add($condition);
		}
	}

	/**
	 * add 
	 * 
	 * @param FieldValueCondition $condition 
	 * @access public
	 * @return void
	 */
	public function add(FieldValueCondition $condition)
	{
		$this->conditions[] = $condition;
	}

	/**
	 * getConditions 
	 * 
	 * @access public
	 * @return void
	 */
	public function getConditions()
	{
		return $this->conditions;
	}

	/**
	 * setConditions 
	 * 
	 * @access public
	 * @return void
	 */
	public function setConditions(array $conditions)
	{
		$this->conditions = $conditions;
		return $this;
	}
	/**
	 * getOperator 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOperator()
	{
		return $this->operator;
	}

	/**
	 * setOperator 
	 * 
	 * @param mixed $operator 
	 * @access public
	 * @return void
	 */
	public function setOperator($operator)
	{
		switch($operator) {
		case self::OPERATOR_OR:
		case self::OPERATOR_AND:
			$this->operator = $operator;
			break;
		default:
			throw new \InvalidArgumentException('Invalid operator is given.');
		}
		
		return $this;
	}
}

