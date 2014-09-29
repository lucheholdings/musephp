<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Calliope\Framework\Core;

/**
 * SchemeRegistryInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemeRegistryInterface extends \Countable, \IteratorAggregate
{
	function hasScheme($class);

	function getSchemeManagers();

	function getSchemeManager($class);

	function addSchemeManager(SchemeManagerInterface $manager);

	function setSchemeManager($class, SchemeManagerInterface $manager);

	function removeScheme($schemeClass);
}

