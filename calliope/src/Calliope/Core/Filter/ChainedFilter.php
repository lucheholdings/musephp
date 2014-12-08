<?php
namespace Calliope\Core\Filter;

use Calliope\Core\Filter;

/**
 * ChainedFilter 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface ChainedFilter
{
	/**
	 * setChain 
	 * 
	 * @param Filter $chain 
	 * @access public
	 * @return void
	 */
	function setChain(Filter $chain);

	/**
	 * getChain 
	 * 
	 * @access public
	 * @return void
	 */
	function getChain();
}

