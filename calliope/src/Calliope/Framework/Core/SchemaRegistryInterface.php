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
 * SchemaRegistryInterface 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface SchemaRegistryInterface extends \Countable, \IteratorAggregate
{
	function hasSchema($class);

	function getSchemaManagers();

	function getSchemaManager($class);

	function addSchemaManager(SchemaManagerInterface $manager);

	function setSchemaManager($class, SchemaManagerInterface $manager);

	function removeSchema($schemeClass);
}

