<?php
namespace Calliope\Extension\Location\Finder;

use Calliope\Extension\Location\Model\LocationInterface;
use Calliope\Extension\Location\LocationProviderInterface;
use Calliope\Extension\Location\LocationTags;

/**
 * LocationFinder 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LocationFinder 
{
	/**
	 * provider 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $provider;

	/**
	 * in 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $in;

	/**
	 * limit 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $limit;

	/**
	 * offset
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $offset;

	/**
	 * __construct 
	 * 
	 * @param LocationProviderInterface $provider 
	 * @access public
	 * @return void
	 */
	public function __construct(LocationProviderInterface $provider)
	{
		$this->provider = $provider;
	}

	/**
	 * in 
	 * 
	 * @param LocationInterface $parent 
	 * @access public
	 * @return void
	 */
	public function in($parent)
	{
		if(is_string($parent)) {
			$parentHash = $parent;
		} else if($parent instanceof LocationInterface) {
			$parentHash = $parent->getHash();
		}

		if($parentHash) {
			$this->in = LocationTags::TAG_PREFIX_IN . $parentHash;
		}
		return $this;
	}

	/**
	 * limit 
	 * 
	 * @param mixed $limit 
	 * @access public
	 * @return void
	 */
	public function limit($limit)
	{
		$this->limit = $limit;
		return $this;
	}

	/**
	 * offset 
	 * 
	 * @param mixed $offset 
	 * @access public
	 * @return void
	 */
	public function offset($offset)
	{
		$this->offset = $offset;
		return $this;
	}

	/**
	 * getResults 
	 * 
	 * @access public
	 * @return void
	 */
	public function getResults()
	{
		return $this->provider->findBy($this->doBuildCriteria(), array(), $this->limit, $this->offset);
	}

	/**
	 * getResult 
	 * 
	 * @access public
	 * @return void
	 */
	public function getResult()
	{
		return $this->provider->findOneBy($this->doBuildCriteria());
	}

	public function count()
	{
		return $this->provider->countBy($this->doBuildCriteria());
	}

	/**
	 * getCriteria 
	 * 
	 * @access public
	 * @return void
	 */
	public function getCriteria()
	{
		return $this->doBuildCriteria();
	}

	/**
	 * doBuildCriteria 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function doBuildCriteria()
	{
		$criteria = array();
		if($this->in) {
			$criteria['tags'][] = $this->in;
		}

		return $criteria;
	}
}

