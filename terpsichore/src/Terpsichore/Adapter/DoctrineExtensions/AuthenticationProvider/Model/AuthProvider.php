<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Terpsichore\Core\Auth\Provider\Info;

/**
 * AuthProvider 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface AuthProviderInfo
{
	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * hasAttribute 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function hasAttribute($key);

	/**
	 * getAttribute 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	function getAttribute($key);

	/**
	 * setAttribute 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	function setAttribute($key, $value);
}

