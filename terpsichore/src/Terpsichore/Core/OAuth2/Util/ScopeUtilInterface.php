<?php
namespace Terpsichore\Core\OAuth2\Util;

/**
 * ScopeUtilInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
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

