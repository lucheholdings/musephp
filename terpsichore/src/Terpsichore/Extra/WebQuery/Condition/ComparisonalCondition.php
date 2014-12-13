<?php
namespace Terpsichore\Extra\WebQuery\Condition;

/**
 * ComparisonalCondition 
 * 
 * @uses FieldValueCondition
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComparisonalCondition implements FieldValueCondition
{
	const OPERATOR_NE       = 1;
	const OPERATOR_EQ       = 2;
	const OPERATOR_GT       = 3;
	const OPERATOR_GE       = 4;
	const OPERATOR_LT       = 5;
	const OPERATOR_LE       = 6;
	const OPERATOR_MATCH    = 7;
	const OPERATOR_IN       = 8;

	const VALUE_IS_RAW    = 1;
	const VALUE_IS_NULL   = 2;
	const VALUE_IS_ANY    = 3;

	/**
	 * operator 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $operator;

	/**
	 * value 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $value;

	protected $valueType;

	/**
	 * __construct 
	 * 
	 * @param mixed $value 
	 * @param mixed $operator 
	 * @access public
	 * @return void
	 */
	public function __construct($value, $operator = self::OPERATOR_EQ)
	{
		$this->value = $value;
		$this->valueType  = self::VALUE_IS_RAW;

		$this->setOperator($operator);
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
		case self::OPERATOR_EQ:
		case self::OPERATOR_NE:
		case self::OPERATOR_GT:
		case self::OPERATOR_GE:
		case self::OPERATOR_LT:
		case self::OPERATOR_LE:
		case self::OPERATOR_MATCH:
		case self::OPERATOR_IN:
			$this->operator = $operator;
			break;
		default:
			throw new \InvalidArgumentException('Invalid operator is given.');
		}
		
		return $this;
	}

	/**
	 * isNull 
	 * 
	 * @access public
	 * @return void
	 */
	public function isValueNull()
	{
		return $this->valueType === self::VALUE_IS_NULL;
	}

	/**
	 * isValueAny 
	 * 
	 * @access public
	 * @return void
	 */
	public function isValueAny()
	{
		return $this->valueType === self::VALUE_IS_ANY;
	}

	public function isValueRaw()
	{
		return $this->valueType === self::VALUE_IS_RAW;
	}
    

	public function asNull()
	{
		$this->valueType = self::VALUE_IS_NULL;
	}
	
	public function asAny()
	{
		$this->valueType = self::VALUE_IS_ANY;
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
        return $this;
    }
}

