<?php
namespace Clio\Component\Util\Hash\Collection;

use Clio\Component\Util\Hash\HashIdentifiable;

/**
 * HashIndexedCollection 
 * 
 * @uses ProxyCollection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HashIndexedCollection extends Collection
{
	/**
	 * createFromCollection 
	 * 
	 * @param mixed $collection 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function createFromCollection($collection) 
	{
		$map = array();
		foreach($collection as $key => $value) {
			if($value instanceof HashIdentifiable) {
				$map[$value->getHash()] = $key;
			}
		}

		return new self($collection, $map);
	}

	protected $keyMap = array();

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($source, array $keyHashMap)
	{
		$this->keyHashMap = $keyHashMap;
		parent::__construct($source);
	}

	/**
	 * hasKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function hasKey($key)
	{
		return parent::hasKey($this->convertHashToKey($key));
	}

	/**
	 * remove 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function removeByKey($key)
	{
		$ret = parent::removeByKey($this->convertHashToKey($key));
		
		unset($this->keyHashMap[$key]);
		return $ret;
	}

	/**
	 * get 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function get($key)
	{
		return parent::get($this->convertHashToKey($key));
	}

	/**
	 * set 
	 * 
	 * @param mixed $key 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function set($key, $value)
	{
		// add hash
		if($value instanceof HashIdentifiable) {
			$this->keyHashMap[$value->getHash()] = $key;
		}
		parent::set($key, $value);
	}

	/**
	 * convertHashToKey 
	 * 
	 * @param mixed $hash 
	 * @access protected
	 * @return void
	 */
	protected function convertHashToKey($hash)
	{
		return isset($this->keyHashMap[$hash]) ? $this->keyHashMap[$hash] : null;
	}
}


