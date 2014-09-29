<?php
namespace Calliope\Extension\Location\Builder;

use Calliope\Extension\Location\Model\LocationInterface,
	Calliope\Extension\Location\Model\Location
;
use Calliope\Extension\Location\LocationTags;

/**
 * LocationBuilder 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LocationBuilder
{
	/**
	 * create 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function create()
	{
		return new static();
	}

	/**
	 * in 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $in = array();

	/**
	 * name 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $name;

	/**
	 * setName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * locatedIn 
	 * 
	 * @param LocationInterface $location 
	 * @access public
	 * @return void
	 */
	public function locatedIn(LocationInterface $location)
	{
		$this->in[] = (string)$location;

		// Get TagCollection of the location 
		$tags = $location->getTags();
		foreach($tags->match(LocationTags::TAG_PREFIX_IN, PatternFilterIterator::MATCH_PREFIX) as $tag) {
			$this->in[] = (string)$tag;
		}
	}

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function build()
	{
		//  
		$location = $this->createLocation();

		return $this->doBuild($location);
	}

	/**
	 * doBuild 
	 * 
	 * @param LocationInterface $location 
	 * @access protected
	 * @return void
	 */
	protected function doBuild(LocationInterface $location)
	{
		// Set locatedIn tags
		$location->setName($this->name);
		$tags = $location->getTags();
		foreach($this->in as $inTag) {
			$tags->addByName($inTag);
		}

		return $location;
	}

	/**
	 * createLocation
	 * 
	 * @access protected
	 * @return void
	 */
	protected function createLocation()
	{
		return new Location();
	}
}
