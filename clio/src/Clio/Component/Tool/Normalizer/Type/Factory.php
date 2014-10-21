<?php
namespace Clio\Component\Tool\Normalizer\Type;

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
	 * createType 
	 *   Create type string to Type instance 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	function createType($name);
}

