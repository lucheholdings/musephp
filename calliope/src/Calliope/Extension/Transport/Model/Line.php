<?php
namespace Calliope\Extension\Transport\Model;

use Clio\Frame\Schemify\Core\Model\TaggableFlexibleScheme;

/**
 * Line 
 * 
 * @uses TaggableFlexibleScheme
 * @uses LineInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Line extends TaggableFlexibleScheme implements LineInterface 
{
	/**
	 * getStationHashes 
	 *   Get all station hashes from tags with prefix "_transport_station." 
	 * @access public
	 * @return void
	 */
	public function getStationHashes()
	{
		$stations = array();
		$prefixLen = strlen(LineTags::TAG_PREFIX_LOCATED_IN);
		foreach($this->getTags()->getNameFilterIterator(LineTags::TAG_PREFIX_LOCATED_IN, 'prefix') as $name) {
			// 
			$station = substr($name, $prefixLex);
			$stations[] = $station;
		}
		return $stations;
	}
}

