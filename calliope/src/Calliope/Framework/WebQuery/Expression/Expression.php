<?php
namespace Calliope\Framework\WebQuery\Expression;

/**
 * Expression 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Expression
{
	/**
	 * match
	 * 
	 * @access public
	 * @return void
	 */
	function match($value);

	/**
	 * eq 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function eq($value);

	/**
	 * ne 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function ne($value);

	/**
	 * gt 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function gt($value);

	/**
	 * ge 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function ge($value);

	/**
	 * lt 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function lt($value);

	/**
	 * le 
	 * 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function le($value);

	/**
	 * isNull 
	 * 
	 * @access public
	 * @return void
	 */
	function isNull();

	/**
	 * isAny
	 * 
	 * @access public
	 * @return void
	 */
	function isAny(); 

	/**
	 * orx 
	 * 
	 * @access public
	 * @return void
	 */
	function orx();

	/**
	 * andx 
	 * 
	 * @access public
	 * @return void
	 */
	function andx();
}

