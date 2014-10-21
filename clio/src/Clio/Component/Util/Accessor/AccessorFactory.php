<?php
namespace Clio\Component\Util\Accessor;

/**
 * Factory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface AccessorFactory
{
	/**
	 * createAccessor 
	 * 
	 * @param mixed $data 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	function createAccessor($data, array $options = array());
}

