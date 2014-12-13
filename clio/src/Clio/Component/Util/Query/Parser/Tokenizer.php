<?php
namespace Clio\Component\Util\Query\Parser;

use Clio\Component\Util\Query\LiteralSet;

/**
 * Tokenizer 
 *    
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Tokenizer 
{
	/* Token Types */
	const T_NONE                     = 0;
	
	const T_LOGIC_OPERATOR           = 1;
	const T_LOGIC_OPERATOR_OR        = 2;
	const T_LOGIC_OPERATOR_AND       = 3;

	const T_COMPARISON_OPERATOR       = 4;
	const T_COMPARISON_OPERATOR_EQ    = 5;
	const T_COMPARISON_OPERATOR_NE    = 6;
	const T_COMPARISON_OPERATOR_GT    = 7;
	const T_COMPARISON_OPERATOR_GE    = 8;
	const T_COMPARISON_OPERATOR_LT    = 9;
	const T_COMPARISON_OPERATOR_LE    = 10;
	const T_COMPARISON_OPERATOR_MATCH = 11;
	const T_COMPARISON_VALUE_NULL     = 12;
	const T_COMPARISON_VALUE_ANY      = 13;

	const T_COLLECTION_OPEN          = 14;
	const T_COLLECTION_CLOSE         = 15;
	const T_COLLECTION_SEPARATOR     = 16;

	
	protected $pos = 0;
	protected $len;
	protected $value;
	protected $tokens;
	protected $literals;

	/**
	 * __construct 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function __construct($value, LiteralSet $literals)
	{
		$this->value = $value;
		$this->literals = $literals;

		$this->reset();
	}

	public function reset()
	{
		$this->tokens = array();
		$this->pos = 0;

		$this->len = strlen($this->value);
	}

	
	/**
	 * match 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function match($token)
	{
		$literal = $this->getLiteralForToken($token);
		
		// If next token is match with the literal, forward the point
		if($literal !== substr($this->value, $this->pos, strlen($literal))) {
			throw new \InvalidArgumentException(sprintf('Token "%s" is not match with next token on "%s"', $literal, substr($this->value, $this->pos)));
		}
		// 
		$this->pos += strlen($literal);

		return $literal;
	}

	public function ignoreSpaces()
	{
	    while($this->pos < $this->len) {
			if(!in_array($this->value[$this->pos], $this->literals->ignores())) {
				break;
			}

			$this->pos++;
		}
	}

	/**
	 * remain 
	 * 
	 * @access public
	 * @return void
	 */
	public function remain()
	{
		$remain = substr($this->value, $this->pos);
		// move pos to end.
		$this->pos = $this->len;
		return $remain;
	}

	/**
	 * isNextToken 
	 * 
	 * @param mixed $token 
	 * @access public
	 * @return void
	 */
	public function isNextToken($token)
	{
		switch($token) {
		case self::T_LOGIC_OPERATOR:
			return 
				$this->isNextToken(self::T_LOGIC_OPERATOR_OR) || 
				$this->isNextToken(self::T_LOGIC_OPERATOR_AND)
			;
			break;
		case self::T_COMPARISON_OPERATOR:
			return 
				$this->isNextToken(self::T_COMPARISON_OPERATOR_EQ) || 
				$this->isNextToken(self::T_COMPARISON_OPERATOR_NE) || 
				$this->isNextToken(self::T_COMPARISON_OPERATOR_GT) || 
				$this->isNextToken(self::T_COMPARISON_OPERATOR_GE) || 
				$this->isNextToken(self::T_COMPARISON_OPERATOR_LT) || 
				$this->isNextToken(self::T_COMPARISON_OPERATOR_LE) || 
				$this->isNextToken(self::T_COMPARISON_OPERATOR_MATCH) 
			;
			break;
		default:
			break;
		}

		$literal = $this->getLiteralForToken($token);
		if ($literal) {
			return ($literal == substr($this->value, $this->pos, strlen($literal)));
		}

		return false;
	}

    /**
     * Get literal.
     *
     * @access public
     * @return literal
     */
    public function getLiterals()
    {
        return $this->literals;
    }
    
    /**
     * Set literal.
     *
     * @access public
     * @param literal the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLiteral(LiteralSet $literals)
    {
        $this->literals = $literals;
        return $this;
    }

	/**
	 * createTokenizer 
	 *   Create InternalTokenizer 
	 * @access public
	 * @return void
	 */
	public function createTokenizer($value)
	{
	   return new self($value, $this->literals);		
	}

	/**
	 * until 
	 * 
	 * @access public
	 * @return void
	 */
	public function until()
	{
	    $tokens = func_get_args();

		$startAt = $this->pos;

	    while($this->pos < $this->len) {
			$isReached = false;
		    foreach($tokens as $token) {
		    	if($this->isNextToken($token)) {
	   				$isReached = true;
	   			}
	    	}

			if($isReached) {
				if(!$this->getLiterals()->isEscapeLiteral($this->value[$this->pos - 1])) {
					// Only if the prev symbol is not escape literal, then break the loop;
					break;
				}
			}
			$this->pos++;
		}

		return substr($this->value, $startAt, $this->pos - $startAt);
	}

	protected function getLiteralForToken($token)
	{
		$literal = null;
		switch($token) {
		case self::T_LOGIC_OPERATOR_OR:
			$literal = $this->getLiterals()->operatorOr();
			break;
		case self::T_LOGIC_OPERATOR_AND:
			$literal = $this->getLiterals()->operatorAnd();
			break;
		case self::T_COMPARISON_OPERATOR_EQ:
			$literal = $this->getLiterals()->operatorEq();
			break;
		case self::T_COMPARISON_OPERATOR_NE:
			$literal = $this->getLiterals()->operatorNe();
			break;
		case self::T_COMPARISON_OPERATOR_GT:
			$literal = $this->getLiterals()->operatorGt();
			break;
		case self::T_COMPARISON_OPERATOR_GE:
			$literal = $this->getLiterals()->operatorGe();
			break;
		case self::T_COMPARISON_OPERATOR_LT:
			$literal = $this->getLiterals()->operatorLt();
			break;
		case self::T_COMPARISON_OPERATOR_LE:
			$literal = $this->getLiterals()->operatorLe();
			break;
		case self::T_COMPARISON_OPERATOR_MATCH:
			$literal = $this->getLiterals()->operatorMatch();
			break;
		case self::T_COMPARISON_VALUE_NULL:
			$literal = $this->getLiterals()->valueNull();
			break;
		case self::T_COMPARISON_VALUE_ANY:
			$literal = $this->getLiterals()->valueAny();
			break;
		case self::T_COLLECTION_OPEN:
			$literal = $this->getLiterals()->collectionOpen();
			break;
		case self::T_COLLECTION_CLOSE:
			$literal = $this->getLiterals()->collectionClose();
			break;
		case self::T_COLLECTION_SEPARATOR:
			$literal = $this->getLiterals()->collectionSeparator();
			break;
		default:
			break;
		}

		return $literal;
	}

	public function isLiteralAs($literal, $token)
	{
		return $literal == $this->getLiteralForToken($token);
	}
    
    /**
     * Get value.
     *
     * @access public
     * @return value
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Set value.
     *
     * @access public
     * @param value the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setValue($value)
    {
        $this->value = $value;

		$this->reset();
        return $this;
    }

}

