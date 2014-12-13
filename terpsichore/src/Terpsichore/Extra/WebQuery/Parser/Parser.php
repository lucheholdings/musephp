<?php
namespace Terpsichore\Extra\WebQuery\Parser;

use Terpsichore\Extra\WebQuery\LiteralSet,
	Terpsichore\Extra\WebQuery\Literal\DefaultLiteralSet;
use Terpsichore\Extra\WebQuery\Parser\Tokenizer;
use Terpsichore\Extra\WebQuery\Condition\FieldCondition,
	Terpsichore\Extra\WebQuery\Condition\ComparisonalCondition,
	Terpsichore\Extra\WebQuery\Condition\CollectionalCondition
;

/**
 * Parser 
 *    
 *    Condition := CollectionCloude | SingleCloude
 *    CollectionColude := LogicOperator ":[" CollectionValue "]" | "[" CollectionValue "]" 
 *    CollectionValue := CollectionCloude "," SingleCloude | SingleCloude "," CollectionCloude | SingleCloude
 *    SingleCloude := ComparisonOperator ":" SingleValue | SingleValue
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Parser
{
	/**
	 * literals 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $literals;

	/**
	 * __construct 
	 * 
	 * @param LiteralSet $literals 
	 * @access public
	 * @return void
	 */
	public function __construct(LiteralSet $literals = null)
	{
		if($literals)
			$this->literals = $literals;
		else 
			$this->literals = new DefaultLiteralSet();
	}

	/**
	 * parse 
	 *   Convert value to FieldCondition
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function parse($field, $value)
	{
		return new FieldCondition($field, $this->parseValue($value));
	}

	/**
	 * parseValue 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function parseValue($value)
	{
		$cond = null;
		if(is_array($value)) {
			// if value is array, then collection with default operator "or"
			$cond = new CollectionalCondition(array(), CollectionalCondition::OPERATOR_OR);
			foreach($value as $v) {
				$cond->add($this->parseValue($v));
			}
		} else {
			// Parse the string
			$tokenizer = $this->createTokenizer((string)$value);
			$cond = $this->parseStringValue($tokenizer);
		}

		return $cond;
	}

	/**
	 * parseStringValue 
	 * 
	 * @param Tokenizer $tokenizer 
	 * @access public
	 * @return void
	 */
	public function parseStringValue(Tokenizer $tokenizer)
	{
		switch(true) {
		case $tokenizer->isNextToken(Tokenizer::T_LOGIC_OPERATOR):
		case $tokenizer->isNextToken(Tokenizer::T_COLLECTION_OPEN):
			// CollectionClause
			// 
			$cond = $this->parseCollectionClause($tokenizer);
			break;
		case $tokenizer->isNextToken(Tokenizer::T_COMPARISON_OPERATOR):
		default:
			// SingleClause
			$cond = $this->parseComparisonClause($tokenizer);
			break;
		}

		return $cond;
	}

	/**
	 * parseCollection 
	 *   CollectionValue := LogicOperator "[" Collection "]" 
	 *   Collection := SingleValue "," Collection | SingleValue
	 * @param mixed $tokenizer 
	 * @access public
	 * @return void
	 */
	public function parseCollectionClause($tokenizer)
	{
		$cond = new CollectionalCondition();

		switch (true) {
		case ($tokenizer->isNextToken($tokenizer::T_LOGIC_OPERATOR_AND)):
			$op = $tokenizer->match($tokenizer::T_LOGIC_OPERATOR_AND);
			$cond->setOperator(CollectionalCondition::OPERATOR_AND);
			break;
		case ($tokenizer->isNextToken($tokenizer::T_LOGIC_OPERATOR_OR)):
			$op = $tokenizer->match($tokenizer::T_LOGIC_OPERATOR_OR);
			$cond->setOperator(CollectionalCondition::OPERATOR_OR);
			break;
		default:
			// use DefaultConditional Operator "or"
			break;
		}
		
		// Start collection
		$tokenizer->match($tokenizer::T_COLLECTION_OPEN);

		do {
			$tokenizer->ignoreSpaces();
			switch (true) {
			case $tokenizer->isNextToken($tokenizer::T_LOGIC_OPERATOR):
			case $tokenizer->isNextToken($tokenizer::T_COLLECTION_OPEN):
				// recursive collection
				$subCond = $this->parseCollectionClause($tokenizer);
				break;
			default:
				// create sub tokenizer until T_COMMA or T_COLLECTION_CLOSE
				$sub = $tokenizer->createTokenizer($this->literals->rtrim($tokenizer->until($tokenizer::T_COLLECTION_SEPARATOR, $tokenizer::T_COLLECTION_CLOSE)));
				
				$subCond = $this->parseComparisonClause($sub);

				if($tokenizer->isNextToken($tokenizer::T_COLLECTION_SEPARATOR)) {
					// forward 
					$tokenizer->match($tokenizer::T_COLLECTION_SEPARATOR);
				}
				break;
			}
			$cond->add($subCond);
		} while(!$tokenizer->isNextToken($tokenizer::T_COLLECTION_CLOSE));
		
		$tokenizer->match($tokenizer::T_COLLECTION_CLOSE);

		return $cond;
	}

	/**
	 * parseComparisonClause
	 *   SingleValue := Comparison ":" Value | Value
	 *   Value := [any value]
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function parseComparisonClause($tokenizer)
	{
		$op = ComparisonalCondition::OPERATOR_EQ;

		switch (true) {
		case $tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_EQ):
			$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_EQ);
			$op = ComparisonalCondition::OPERATOR_EQ; 
			break;
		case $tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_NE):
			$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_NE);
			$op = ComparisonalCondition::OPERATOR_NE; 
			break;
		case $tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_GT):
			$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_GT);
			$op = ComparisonalCondition::OPERATOR_GT; 
			break;
		case $tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_GE):
			$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_GE);
			$op = ComparisonalCondition::OPERATOR_GE; 
			break;
		case $tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_LT):
			$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_LT);
			$op = ComparisonalCondition::OPERATOR_LT; 
			break;
		case $tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_LE):
			$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_LE);
			$op = ComparisonalCondition::OPERATOR_LE; 
			break;
		case $tokenizer->isNextToken($tokenizer::T_COMPARISON_OPERATOR_MATCH):
			$tokenizer->match($tokenizer::T_COMPARISON_OPERATOR_MATCH);
			$op = ComparisonalCondition::OPERATOR_MATCH; 
			break;
		default:
			// use DefaultConditional Operator "eq"
			break;
		}

		$value = $tokenizer->remain();
		$cond = new ComparisonalCondition($value, $op);

		if($op == ComparisonalCondition::OPERATOR_EQ) {
			if($tokenizer->isLiteralAs($value, $tokenizer::T_COMPARISON_VALUE_NULL)) {
				$cond->asNull();
			} else  if($tokenizer->isLiteralAs($value, $tokenizer::T_COMPARISON_VALUE_ANY)) {
				$cond->asAny();
			}
		}

		return $cond;
	}

	/**
	 * createTokenizer 
	 *   Create Default Tokenizer 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function createTokenizer($value)
	{
		return new Tokenizer($value, $this->literals);
	}
}

