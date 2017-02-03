<?php
namespace Clio\Component\Util\Container\Iterator;

use Clio\Component\Util\Psr\Psr;
/**
 * PropertyFilterIterator
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class PropertyFilterIterator extends \FilterIterator
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
	public function __construct(\Iterator $iterator, $pattern, $property, $type = self::MATCH)
	{
		parent::__construct($iterator);

		$this->property = $property;
		// 
		if(is_string($type)) {
			$this->type = 0;
			if(0 === strpos('not ', $type)) {
				$this->type = self::NOT_MATCH;
			}

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
		$value = $this->getPropertyValueOf($this->current());
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

	protected function getPropertyValueOf($object)
	{
		if(!is_object($object)) {
			throw new \Clio\Component\Exception\Exception('Value has to be an object.');
		}

		$method = Psr::methodName('get ' . $this->property);

		$reflection = new \ReflectionObject($object);
		if($reflection->hasMethod($method)) {
			return $reflection->getMethod($method)->invoke($object);
		} else if($reflection->hasProperty($this->property) && $reflection->getProperty($this->property)->isPublic()) {
			return $reflection->getProperty($this->property)->getValue();
		}

		throw new \Clio\Component\Exception\RuntimeException('Property "%s" is not accessable or exists.', $this->property);
	}
}

