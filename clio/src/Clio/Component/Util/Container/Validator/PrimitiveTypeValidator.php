<?php
namespace Clio\Component\Util\Container\Validator;

/**
 * PrimitiveTypeValidator 
 * 
 * @uses Validator
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PrimitiveTypeValidator implements Validator
{
	/**
	 * type 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $type;

	/**
	 * __construct 
	 * 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function __construct($type)
	{
		switch($type) {
		case 'bool':
		case 'string':
		case 'int':
		case 'double':
		case 'float':
		case 'numeric':
		case 'object':
			$this->type = $type;
			break;
		default:
			throw new \Clio\Component\Exception\InvalidArgumentException(sprintf('Invalid type "%s" is given.', $type));
			break;
		}
	}

	/**
	 * validate 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function validate($value)
	{
		$isValid = false;

		switch($this->type) {
		case 'bool':
			$isValid = is_bool($value);
			break;
		case 'string':
			$isValid = is_string($value);
			break;
		case 'int':
			$isValid = is_int($value);
			break;
		case 'double':
			$isValid = is_double($value);
			break;
		case 'float':
			$isValid = is_float($value);
			break;
		case 'numeric':
			$isValid = is_numeric($value);
			break;
		case 'object':
			$isValid = is_object($value);
			break;
		default:
			break;
		}

		if(!$isValid) {
			throw new \Clio\Component\Exception\RuntimeException(sprintf('PrimitiveTypeValidator failed. Has to be a "%s" value.', $this->type));
		}

		return $value;
	}
    
    /**
     * Get type.
     *
     * @access public
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }
}
