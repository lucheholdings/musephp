<?php
namespace Calliope\Extension\Transport\Entity\MappedSuperclass;

use Calliope\Adapter\Doctrine\Core\Entity\MappedSuperclass\TaggableFlexibleModel;
use Calliope\Extension\Transport\Model\LineInterface;

use Doctrine\ORM\Mapping as ORM;

/**
 * Line 
 * 
 * @uses TaggableFlexibleModel
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 * 
 * @ORM\MappedSuperclass()
 */
abstract class Line extends TaggableFlexibleModel implements LineInterface
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
