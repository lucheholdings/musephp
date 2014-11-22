<?php
namespace Calliope\Core\Filter;

/**
 * Factory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Factory
{
	/**
	 * createFilter 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createFilter(array $options = array());
}

