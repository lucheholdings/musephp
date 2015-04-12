<?php
namespace Clio\Component\Pattern\Builder;

/**
 * Factory 
 *   Interface of BuilderFactory. 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Factory
{
	/**
	 * createBuilder 
	 * 
	 * @access public
	 * @return void
	 */
	function createBuilder();
}