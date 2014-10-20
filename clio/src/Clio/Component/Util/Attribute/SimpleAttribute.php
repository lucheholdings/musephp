<?php
namespace Clio\Component\Util\Attribute;

use Clio\Component\Util\Pair\SimpleKeyValuePair;

/**
 * SimpleAttribute 
 * 
 * @uses Attribute
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class SimpleAttribute extends SimpleKeyValuePair implements Attribute
{
	/**
	 * owner 
	 *   Owner Metadata  
	 * @var mixed
	 * @access protected
	 */
	protected $owner;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($key = null, $value = null, $owner = null)
	{
		parent::__construct($key, $value);

		$this->owner = $owner;
	}

	/**
	 * getOwner 
	 * 
	 * @access public
	 * @return void
	 */
	public function getOwner()
	{
		return $this->owner;
	}

	/**
	 * setOwner 
	 * 
	 * @param mixed $owner 
	 * @access public
	 * @return void
	 */
	public function setOwner($owner)
	{
		$this->owner = $owner;
	}
}
