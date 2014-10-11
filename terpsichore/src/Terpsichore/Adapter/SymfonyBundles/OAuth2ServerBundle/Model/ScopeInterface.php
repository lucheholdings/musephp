<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model;

/**
 * ScopeInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface ScopeInterface
{
	/**
	 * getId 
	 * 
	 * @access public
	 * @return void
	 */
	function getId();

	/**
	 * getName 
	 * 
	 * @access public
	 * @return void
	 */
	function getName();

	/**
	 * __toString 
	 * 
	 * @access protected
	 * @return void
	 */
	function __toString();
}

