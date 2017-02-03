<?php
namespace Clio\Component\Util\Hash\Collection;

use Clio\Component\Util\Container\Collection\Collection;
use Clio\Component\Util\Hash\HashIdentifiable;

/**
 * HashCollection
 * 
 * @uses Collection
 * @uses HashCollectionInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class HashCollection extends Collection implements HashCollectionInterface 
{
	/**
	 * add 
	 * 
	 * @param mixed $hash 
	 * @access public
	 * @return void
	 */
	public function add($hash)
	{
		if($hash instanceof HashIdentifiable) {
			$hashString = $hash->getHash();
		} else if(is_string($hash)) {
			$hashString = $hash;
		} else {
			throw new \Clio\Component\Exception\InvalidArgumentException('HashCollection only accept HashIdentifiable or hash string.');
		}
		$this->offsetSet($hashString, $hash);

		return $this;
	}

	/**
	 * offsetSet 
	 * 
	 * @param mixed $index 
	 * @param mixed $newval 
	 * @access public
	 * @return void
	 */
	public function offsetSet($index , $newval)
	{
		if(!is_string($newval) && !($newval instanceof HashIdentifiable)) {
			throw new \Clio\Component\Exception\InvalidArgumentException('HashCollection only accept HashIdentifiable or hash string.');
		}
		parent::offsetSet($index, $newval);
	}

	/**
	 * removeName 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function removeHash($hash)
	{
		array_walk($this, function($val, $key) use ($hash) {
			if($hash == $val) {
				unset($this[$key]);
			}
		});
	}

	/**
	 * toHashArray 
	 * 
	 * @access public
	 * @return void
	 */
	public function toHashArray()
	{
		$hashes = array();
		foreach($this as $hash) {
			if($hash instanceof HashIdentifiable) {
				$hashes[] = $hash->getHash();
			} else {
				$hashes[] = (string)$hash;
			}
		}

		return $hashes;
	}
}
