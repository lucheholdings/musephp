<?php
namespace Calliope\Extension\Transport;

use Calliope\Geo\Location\Core\LocationTags;

/**
 * StationTags 
 * 
 * @uses LocationTags
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class StationTags extends LocationTags
{
	const TAG_PREFIX_LINE = '_transport_line.';

	/**
	 * nameLineTag 
	 * 
	 * @param mixed $name 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function nameLineTag($name)
	{
		if(0 !== strpos(self::TAG_PREFIX_LINE, (string)$name))
			return sprintf(self::TAG_PREFIX_LINE. (string)$name);
		return (string)$name;
	}
}

