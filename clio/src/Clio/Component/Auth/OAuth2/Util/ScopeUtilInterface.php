<?php
namespace Clio\Component\Auth\OAuth2\Util;

/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
interface ScopeUtilInterface
{
	/**
	 * getDelimiter
	 *   Return scope delimiter 
	 * @access public
	 * @return char|string
	 */
	function getDelimiter();

	/**
	 * fromArray 
	 * 
	 * @access public
	 * @return void
	 */
	function fromArray(array $scopes);

	/**
	 * toArray 
	 * 
	 * @param mixed $scope 
	 * @access public
	 * @return void
	 */
	function toArray($scope);
}

