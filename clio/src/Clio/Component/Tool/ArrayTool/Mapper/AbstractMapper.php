<?php
namespace Clio\Component\Tool\ArrayTool\Mapper;

/**
 * AbstractMapper 
 * 
 * @uses StorageMap
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMapper implements Mapper 
{
	/**
	 * strict 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strict = false;

	/**
	 * __construct 
	 * 
	 * @param array $maps 
	 * @param mixed $strict 
	 * @access public
	 * @return void
	 */
	public function __construct($strict = true)
	{
		$this->strict = $strict;
	}

	/**
	 * isStrict 
	 * 
	 * @access public
	 * @return void
	 */
	public function isStrict()
	{
		return $this->strict;
	}

	/**
	 * disableStrict 
	 * 
	 * @access public
	 * @return void
	 */
	public function disableStrict()
	{
		$this->strict = false;
	}

	/**
	 * enableStrict 
	 * 
	 * @access public
	 * @return void
	 */
	public function enableStrict()
	{
		$this->strict = true;
	}
}

