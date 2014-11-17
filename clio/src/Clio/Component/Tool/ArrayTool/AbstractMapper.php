<?php
namespace Clio\Component\Tool\ArrayTool;

use Clio\Component\Util\Container\Map\Map;

/**
 * AbstractMapper 
 * 
 * @uses Map
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMapper extends Map
{
	/**
	 * strict 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $strict;

	/**
	 * __construct 
	 * 
	 * @param array $maps 
	 * @param mixed $strict 
	 * @access public
	 * @return void
	 */
	public function __construct(array $maps = array(), $strict = true)
	{
		parent::__construct($maps);
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

	/**
	 * {@inheritdoc}
	 */
	public function serialize()
	{
		if(!$this->getStorage() instanceof \Serializable) {
			throw new \RuntimeException('Container storage is not serializable.');
		}

		return serialize(array(
			$this->getStorage(),
			$this->strict
		));
	}

	/**
	 * {@inheritdoc}
	 */
	public function unserialize($serialized)
	{
		$data = unserialize($serialized);

		list(
			$storage,
			$this->strict
		) = $data;

		$this->setStorage($storage);
	}
}

