<?php
namespace Calliope\Bridge\SymfonyComponents\Filter;

/**
 * ListenerFactory 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface ListenerFactory
{
	/**
	 * createArgs 
	 * 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	function createArgs(array $args);
}
