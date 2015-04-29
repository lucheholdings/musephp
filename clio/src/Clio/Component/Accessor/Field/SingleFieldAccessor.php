<?php
namespace Clio\Component\Accessor\Field;

use Clio\Component\Accessor\FieldAccessor;

/**
 * SingleFieldAccessor 
 * 
 * @uses FieldAccessor
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SingleFieldAccessor extends FieldAccessor
{
	/**
	 * get 
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	function get($container);

	/**
	 * set 
	 * 
	 * @param mixed $container 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function set($container, $value);

	/**
	 * isNull
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	function isNull($container);

	/**
	 * clear
	 * 
	 * @param mixed $container 
	 * @access public
	 * @return void
	 */
	function clear($container);

	/**
	 * getFieldName 
	 * 
	 * @access public
	 * @return void
	 */
	function getFieldName();

    /**
     * isSupportedAccess 
     * 
     * @param mixed $container 
     * @access public
     * @return void
     */
    function isSupportedAccess($container, $accessType);
}

