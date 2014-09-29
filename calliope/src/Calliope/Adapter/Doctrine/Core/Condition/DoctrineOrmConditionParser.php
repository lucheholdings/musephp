<?php
namespace Calliope\Adapter\Doctrine\Core\Condition;

use Doctrine\ORM\Query\Expr;

/**
 * ConditionParser 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineOrmConditionParser 
{
	/**
	 * tokenizer 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $tokenizer;

	/**
	 * expressionBuilder 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $expressionBuilder;

	/**
	 * __construct 
	 * 
	 * @param Tokenizer $tokenizer 
	 * @param $expressionBuilder 
	 * @access public
	 * @return void
	 */
	public function __construct($expressionBuilder, Tokenizer $tokenizer = null)
	{
		$this->tokenizer = $tokenizer;
		$this->expressionBuilder = $expressionBuilder;
	}

	/**
	 * expr 
	 * 
	 * @access public
	 * @return void
	 */
	public function expr()
	{
		return $this->expressionBuilder;
	}

	/**
	 * parse 
	 * 
	 * @param mixed $field 
	 * @param mixed $value 
	 * @access public
	 * @return array[Condtion, array]
	 */
	public function parse($field, $value)
	{
		$paramName = str_replace('.', '_', $field);
		$literal = $this->getTokenizer()->tokenize($value);
		$params = array();

		switch($literal->getOperator()) {
		case Comparisons::OPERATOR_NOT:
			$value = $literal->getValue();
			if(is_numeric($value)) {
				$cond = $this->expr()->neq($field, $literal->getValue());
			} else {
				$cond = $this->expr()->neq($field, ':'.$paramName);
				$params[$paramName] = $value;
			}
			break;
		case Comparisons::OPERATOR_NULL:
			$cond = $this->expr()->isNull($field);
			break;
		case Comparisons::OPERATOR_NOT_NULL:
			$cond = $this->expr()->isNotNull($field);
			break;
		case Comparisons::OPERATOR_IN:
			$cond = $this->expr()->in($field, $value);
			break;
		case Comparisons::OPERATOR_MATCH:
			$cond = $this->expr()->like($field, $this->expr()->literal($literal->getValue()));
			break;
		case Comparisons::OPERATOR_GT:
			$value = $literal->getValue();
			if(is_numeric($value)) {
				$cond = $this->expr()->gt($field, $literal->getValue());
			} else {
				$cond = $this->expr()->gt($field, ':'.$paramName);
				$params[$paramName] = $value;
			}
			break;
		case Comparisons::OPERATOR_GE:
			$value = $literal->getValue();
			if(is_numeric($value)) {
				$cond = $this->expr()->gte($field, $literal->getValue());
			} else {
				$cond = $this->expr()->gte($field, ':'.$paramName);
				$params[$paramName] = $value;
			}
			break;
		case Comparisons::OPERATOR_LT:
			$value = $literal->getValue();
			if(is_numeric($value)) {
				$cond = $this->expr()->lt($field, $literal->getValue());
			} else {
				$cond = $this->expr()->lt($field, ':'.$paramName);
				$params[$paramName] = $value;
			}
			break;
		case Comparisons::OPERATOR_LE:
			$value = $literal->getValue();
			if(is_numeric($value)) {
				$cond = $this->expr()->lte($field, $literal->getValue());
			} else {
				$cond = $this->expr()->lte($field, ':'.$paramName);
				$params[$paramName] = $value;
			}
			break;
		case Comparisons::OPERATOR_EQ:
		default:
			if(is_numeric($value)) {
				$cond = $this->expr()->eq($field, $literal->getValue());
			} else {
				$cond = $this->expr()->eq($field, ':'.$paramName);
				$params[$paramName] = $value;
			}
			break;
		}

		return array($cond, $params);
	}
    
    /**
     * Get tokenizer.
     *
     * @access public
     * @return tokenizer
     */
    public function getTokenizer()
    {
		if(!$this->tokenizer) {
			$this->tokenizer = new DefaultTokenizer();
		}
        return $this->tokenizer;
    }
    
    /**
     * Set tokenizer.
     *
     * @access public
     * @param tokenizer the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setTokenizer($tokenizer)
    {
        $this->tokenizer = $tokenizer;
        return $this;
    }
    
    /**
     * Get expressionBuilder.
     *
     * @access public
     * @return expressionBuilder
     */
    public function getExpressionBuilder()
    {
        return $this->expressionBuilder;
    }
    
    /**
     * Set expressionBuilder.
     *
     * @access public
     * @param expressionBuilder the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setExpressionBuilder($expressionBuilder)
    {
        $this->expressionBuilder = $expressionBuilder;
        return $this;
    }
}

