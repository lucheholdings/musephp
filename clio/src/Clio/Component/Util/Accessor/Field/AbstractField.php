<?php
namespace Clio\Component\Util\Accessor\Field;

use Clio\Component\Util\Accessor\Field;

/**
 * AbstractField 
 * 
 * @uses Field
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractField implements Field
{
	/**
	 * alias 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $alias;

	/**
	 * __construct 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function __construct($alias)
	{
		$this->alias = $alias;
	}

	/**
	 * getAlias 
	 * 
	 * @access public
	 * @return void
	 */
	public function getAlias()
	{
		if($this->alias)
			return $this->alias;

		return $this->getName();
	}

	/**
	 * setAlias 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function setAlias($alias)
	{
		$this->alias = $alias;
	}
}

