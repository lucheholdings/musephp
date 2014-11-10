<?php
namespace Clio\Component\Util\Accessor\Schema;

use Clio\Component\Pattern\Factory\MappedFactory;

/**
 * NamedAccessorFactory 
 * 
 * @uses MappedFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
interface NamedAccessorFactory extends MappedFactory 
{
	const ARG_NAME    = 'name';
	const ARG_OPTIONS = 'options';

	/**
	 * createSchemaAccessorByName 
	 * 
	 * @param mixed $name 
	 * @param arrayn $options 
	 * @access public
	 * @return void
	 */
	function createSchemaAccessorByName($name, array $options = array());
}

