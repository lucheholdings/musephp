<?php
namespace Clio\Component\ArrayTool\Mapper;

/**
 * Mapper
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface Mapper 
{
	/**
	 * map 
	 * 
	 * @param array $values 
	 * @access public
	 * @return void
	 */
	function map(array $values);

	/**
	 * inverseMap 
	 * 
	 * @param array $values 
	 * @access public
	 * @return void
	 */
	function inverseMap(array $values);
}

