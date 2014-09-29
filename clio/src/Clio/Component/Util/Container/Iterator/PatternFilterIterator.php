<?php
namespace Clio\Component\Util\Container\Iterator;

/**
 * PatternFilterIterator
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class PatternFilterIterator extends \FilterIterator
{
	// BIT FLAG on last 2bit
	const MATCH             = 0;
	const MATCH_PREFIX      = 1;
	const MATCH_POSTFIX     = 2;
	const MATCH_PREG        = 3;

	const NOT_MATCH         = 32;

	/**
	 * pattern 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $pattern;

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
	 * @access public
	 * @return void
	 */
	public function __construct(\Iterator $iterator, $pattern, $type = self::MATCH)
	{
		parent::__construct($iterator);

		// 
		if(is_string($type)) {
			$this->type = 0;

			$types = explode(' ', trim($type));
			if(in_array('not', $types)) {
				// 
				unset($types[array_search('not', $types)]);
				$this->type = self::NOT_MATCH;
			}
			
			if(1 !== count($types)) {
				throw new \Clio\Component\Exception\RuntimeException(sprintf('Unknown types "%s"', $type));
			} 

			$type = reset($types);
			switch($type) {
			case 'match':
				$this->type |= self::MATCH;
				break;
			case 'prefix':
				$this->type |= self::MATCH_PREFIX;
				break;
			case 'postfix':
				$this->type |= self::MATCH_POSTFIX;
				break;
			case 'preg':
				$this->type |= self::MATCH_PREG;
				break;
			default:
				throw new \Clio\Component\Exception\InvalidArgumentException('Type has to be one of [match, prefix, postfix, preg] with/without "not " prefix.');
			}
		} else {
			$this->type = $type;
		}

		// 
		$this->preparePattern($pattern);
	}

	/**
	 * accept 
	 * 
	 * @access public
	 * @return void
	 */
	public function accept()
	{
		$isAccept = false;


		$value = $this->current();

		//
		$checkflg = $this->type & ~self::NOT_MATCH;
		switch($checkflg) {
		case self::MATCH:
			$isAccept = ($this->pattern === $value);
			break;
		case self::MATCH_PREFIX:
			$isAccept = (0 === strpos($value, $this->pattern));
			break;
		case self::MATCH_POSTFIX:
			$isAccept = (strlen($value) - $patternLen) === strrpos($value, $this->pattern);
			break;
		case self::MATCH_PREG:
			$isAccept = preg_match($this->pattern, $value);
			break;
		default:
			throw new \Clio\Component\Exception\RuntimeException('Invalid match type is specified on accept().');
			break;
		}
		
		if($this->type & self::NOT_MATCH) {
			$isAccept = !$isAccept;	
		}
		
		return $isAccept;
	}

	protected function preparePattern($pattern)
	{
		$checkflg = $this->type & (~self::NOT_MATCH);

		switch($checkflg) {
		case self::MATCH:
		case self::MATCH_PREFIX:
		case self::MATCH_POSTFIX:
		case self::MATCH_PREG:
			$this->pattern = $pattern;
			break;
		default:
			throw new \Clio\Component\Exception\RuntimeException('Invalid match type is specified.');
			break;
		}
	}
}

