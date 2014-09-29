<?php
namespace Calliope\Extension\Location;

use Calliope\Extension\Location\Type\TypeInterface;

/**
 * LocationTags 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LocationTags 
{
	// Prefixes
	const TAG_PREFIX_IN   = '_located_in.';
	const TAG_PREFIX_TYPE = '_type.';
	
	/**
	 * nameInLocation
	 * 
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function nameLocatedInTag($name)
	{
		if(0 !== strpos(self::TAG_PREFIX_IN, (string)$name))
			return sprintf(self::TAG_PREFIX_IN . (string)$name);
		return (string)$name;
	}

	/**
	 * nameType 
	 * 
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function nameTypeTag($name)
	{
		if(0 !== strpos(self::TAG_PREFIX_TYPE, (string)$name))
			return sprintf(self::TAG_PREFIX_TYPE . (string)$name);
		return (string)$name;
	}

	/**
	 * typeTagFor 
	 * 
	 * @param TypeInterface $type 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function typeTagFor(TypeInterface $type)
	{
		return self::nameTypeTag($type->getName());
	}
}

