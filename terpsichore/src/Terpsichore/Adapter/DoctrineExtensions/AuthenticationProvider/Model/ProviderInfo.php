<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Adapter\DoctrineExtensions\AuthenticationProvider\Model;

/**
 * ProviderInfo 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ProviderInfo 
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * hasProvider 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function has($key);

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function get($key);

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function set($key, $value);

	/**
	 * get 
	 * 
	 * @access public
	 * @return void
	 */
	function getKeyValues();
}

