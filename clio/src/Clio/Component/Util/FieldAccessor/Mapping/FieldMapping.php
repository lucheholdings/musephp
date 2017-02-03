<?php
namespace Clio\Component\Util\FieldAccessor\Mapping;

/**
 * FieldMapping 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface FieldMapping 
{
	/**
	 * getClassMapping 
	 * 
	 * @access public
	 * @return void
	 */
	function getClassMapping();

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * isSkipField 
	 * 
	 * @access public
	 * @return void
	 */
	function isSkipField();

	/**
	 * isIgnoreField 
	 * 
	 * @access public
	 * @return void
	 */
	function isIgnoreField();

	/**
	 * getAccessType 
	 * 
	 * @access public
	 * @return void
	 */
	function getAccessType();

	/**
	 * getGetterMethod 
	 * 
	 * @access public
	 * @return void
	 */
	function getGetterMethod();

	/**
	 * getSetterMethod 
	 * 
	 * @access public
	 * @return void
	 */
	function getSetterMethod();
}
