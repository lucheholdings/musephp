<?php
namespace Terpsichore\Extra\WebQuery\Condition\Resolver;

use Terpsichore\Extra\WebQuery\Parser\Parser;

use Terpsichore\Extra\WebQuery\Condition\FieldCondition,
	Terpsichore\Extra\WebQuery\Condition\FieldValueCondition,
	Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition,
	Terpsichore\Extra\WebQuery\Condition\CollectionalCondition
;
/**
 * ConditionResolver 
 * 
 * @uses ConditionResolverInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ConditionResolver implements ConditionResolverInterface
{
	/**
	 * parser 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $parser; 

	/**
	 * __construct 
	 * 
	 * @param Expression $expression 
	 * @access public
	 * @return void
	 */
	public function __construct(Parser $parser = null)
	{
		if($parser)
			$this->parser = $parser;
		else
			$this->parser = new Parser();
	}
    
    /**
     * Get expression.
     *
     * @access public
     * @return expression
     */
    public function parser()
    {
        return $this->parser;
    }

	/**
	 * resolveFieldCondition 
	 * 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function resolveCondition($field, $value)
	{
		// Create Condition with parser
		$condition = $this->parser()->parse($field, $value);

		// Optimize it
		if($condition) {
			$condition = $this->optimize($condition);
		}
		return $condition;
	}

	public function optimize(FieldCondition $condition)
	{
		if($condition->getValueCondition()) {
			$condition->setValueCondition($this->doOptimize($condition->getValueCondition()));
		}

		return $condition;
	}

	protected function doOptimize(FieldValueCondition $condition)
	{
		if($condition instanceof CollectionalCondition) {
			$canBeInOp = false;
			if(CollectionalCondition::OPERATOR_OR == $condition->getOperator()) {
				$canBeInOp = true;
			}
			$values = array();
			$conds = $condition->getConditions();
			// 
			foreach($conds as $key => $innerCond) {

				$innerCond = $this->doOptimize($innerCond);
				if($innerCond instanceof ComparisonalCondition) {
					if(ComparisonalCondition::OPERATOR_EQ != $innerCond->getOperator() || !$innerCond->isValueRaw()) {
						$canBeInOp = false;
					}
					$values[] = $innerCond->getValue(); 
				}
				
				// replace the condition
				$conds[$key] = $innerCond;
			}
			
			if($canBeInOp) {
				$condition = new ComparisonalCondition($values, ComparisonalCondition::OPERATOR_IN);
			} else {
				$condition->setConditions($conds);
			}
		}

		return $condition;
	}
}

