<?php
namespace Clio\Component\Util\Container\Tests\Iterator;

class Str
{
	private $str;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct($str)
	{
		$this->str = $str;
	}

	/**
	 * getUpperCase 
	 * 
	 * @access public
	 * @return void
	 */
	public function getUpperCase()
	{
		return strtoupper($this->str);
	}
}

