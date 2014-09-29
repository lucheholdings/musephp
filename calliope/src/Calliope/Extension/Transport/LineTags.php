<?php
namespace Calliope\Extension\Transport;

/**
 * LineTags 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LineTags
{
	/* 
	 * Tag for Where the line is located in.
	 * Line is not a spot
	 */
	const TAG_PREFIX_LOCATED_IN = '_located_in.';

	/* 
	 * Tag for stations which placed on this line.
	 */
	const TAG_PREFIX_STATION = '_transport_station.';

	/**
	 * nameStationTag 
	 * 
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function nameStationTag($name)
	{
		if(0 !== strpos(self::TAG_PREFIX_STATION, (string)$name))
			return sprintf(self::TAG_PREFIX_STATION . (string)$name);
		return (string)$name;
	}

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
}

