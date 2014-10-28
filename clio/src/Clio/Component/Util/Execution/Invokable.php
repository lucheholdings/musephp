<?php
namespace Clio\Component\Util\Execution;

/**
 * Invokable 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Invokable
{
	/**
	 * __invoke 
	 *    
	 * @access protected
	 * @return void
	 */
	function __invoke();
}

