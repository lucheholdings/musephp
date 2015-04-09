<?php
namespace Clio\Component\Pattern\Factory;

/**
 * MappedFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface MappedFactory 
{
	/**
	 * createByKey 
	 * 
	 * @access public
	 * @return void
	 */
	function createByKey($key);

	/**
	 * createByKeyArgs 
	 * 
	 * @param mixed $key 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	function createByKeyArgs($key, array $args = array());

    /**
     * canCreateByKey 
     * 
     * @param mixed $key 
     * @param array $args 
     * @access public
     * @return void
     */
	function canCreateByKey($key);
}

