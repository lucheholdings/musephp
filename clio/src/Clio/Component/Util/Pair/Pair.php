<?php
namespace Clio\Component\Util\Pair;

interface Pair
{
	/**
	 * setFirst 
	 * 
	 * @param mixed $first 
	 * @access public
	 * @return void
	 */
	function setFirst($first);

	/**
	 * getFirst 
	 * 
	 * @access public
	 * @return void
	 */
	function getFirst();

	/**
	 * setSecond 
	 * 
	 * @param mixed $second 
	 * @access public
	 * @return void
	 */
	function setSecond($second);

	/**
	 * getSecond 
	 * 
	 * @access public
	 * @return void
	 */
	function getSecond();
}

