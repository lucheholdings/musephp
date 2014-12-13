<?php
namespace Clio\Component\Util\Query\Literal;

use Clio\Component\Util\Query\LiteralSet;
use Clio\Component\Util\Query\Tokenizer;

/**
 * DefaultLiteralSet 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DefaultLiteralSet implements LiteralSet
{
    /* Comparison Operator Literals */
    // "=:value"
    const LT_OPERATOR_EQ       = '=';
    // "!=:value"
    const LT_OPERATOR_NE       = '!=';
    // ">:value"
    const LT_OPERATOR_GT       = '>';
    // ">=:value"
    const LT_OPERATOR_GE       = '>=';
    // "<:value"
    const LT_OPERATOR_LT       = '<';
    // "<=:value"
    const LT_OPERATOR_LE       = '<=';
    // "%:*value*"
    const LT_OPERATOR_MATCH    = '%';

    /* Collection Operator Literal */
    // "or:[values...]"
    const LT_OPERATOR_OR         = 'or';
    // "and:[values...]"
    const LT_OPERATOR_AND        = 'and';
    // "[value1 , value2 , ...]"
    const LT_COLLECTION_OPEN       = '[';
    const LT_COLLECTION_CLOSE      = ']';
    const LT_COLLECTION_SEPARATOR  = ',';
    // 
    const LT_OPERATOR_END        = ':';

    // Special values for EQ Operator
    // "=:~"
    const LT_VALUE_NULL        = '~';
    // "=:*" 
    const LT_VALUE_ANY         = '*';

    // Escape char
    const LT_ESCAPE            = "\\";

    const LT_SPACE             = ' ';
    const LT_TAB               = "\t";

    /**
     * operatorEq 
     * 
     * @access public
     * @return void
     */
    public function operatorEq()
    {
        return $this->decorateOperator(static::LT_OPERATOR_EQ);
    }

    /**
     * operatorNe 
     * 
     * @access public
     * @return void
     */
    public function operatorNe()
    {
        return $this->decorateOperator(static::LT_OPERATOR_NE);
    }

    /**
     * operatorGt 
     * 
     * @access public
     * @return void
     */
    public function operatorGt()
    {
        return $this->decorateOperator(static::LT_OPERATOR_GT);
    }

    /**
     * operatorGe 
     * 
     * @access public
     * @return void
     */
    public function operatorGe()
    {
        return $this->decorateOperator(static::LT_OPERATOR_GE);
    }

    /**
     * operatorLt 
     * 
     * @access public
     * @return void
     */
    public function operatorLt()
    {
        return $this->decorateOperator(static::LT_OPERATOR_LT);
    }

    /**
     * operatorLe 
     * 
     * @access public
     * @return void
     */
    public function operatorLe()
    {
        return $this->decorateOperator(static::LT_OPERATOR_LE);
    }

    /**
     * operatorMatch 
     * 
     * @access public
     * @return void
     */
    public function operatorMatch()
    {
        return $this->decorateOperator(static::LT_OPERATOR_MATCH);
    }

    /**
     * operatorOr 
     * 
     * @access public
     * @return void
     */
    public function operatorOr()
    {
        return $this->decorateOperator(static::LT_OPERATOR_OR);
    }

    /**
     * operatorAnd 
     * 
     * @access public
     * @return void
     */
    public function operatorAnd()
    {
        return $this->decorateOperator(static::LT_OPERATOR_AND);
    }

    /**
     * collectionOpen 
     * 
     * @access public
     * @return void
     */
    public function collectionOpen()
    {
        return static::LT_COLLECTION_OPEN;
    }

    /**
     * collectionClose 
     * 
     * @access public
     * @return void
     */
    public function collectionClose()
    {
        return static::LT_COLLECTION_CLOSE;
    }

    /**
     * collectionSeparator 
     * 
     * @access public
     * @return void
     */
    public function collectionSeparator()
    {
        return static::LT_COLLECTION_SEPARATOR;
    }

    /**
     * decorateOperator 
     * 
     * @param mixed $op 
     * @access public
     * @return void
     */
    public function decorateOperator($op)
    {
        return $op . static::LT_OPERATOR_END;
    }

    /**
     * valueNull 
     * 
     * @access public
     * @return void
     */
    public function valueNull()
    {
        return static::LT_VALUE_NULL;
    }

    /**
     * valueAny 
     * 
     * @access public
     * @return void
     */
    public function valueAny()
    {
        return static::LT_VALUE_ANY;
    }

    /**
     * isEscapeLiteral 
     * 
     * @param mixed $char 
     * @access public
     * @return void
     */
    public function isEscapeLiteral($char)
    {
        return ($char == static::LT_ESCAPE);
    }

	public function decodeValue($value)
	{
		return urldecode($value);
	}

	public function encodeValue($value)
	{
		return urlencode($value);
	}

	public function rtrim($value)
	{
		return rtrim($value, self::LT_SPACE . self::LT_TAB);
	}

	public function ignores()
	{
		return array(
			self::LT_SPACE,
			self::LT_TAB,
		);
	}
}
