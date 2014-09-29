<?php
namespace Clio\Component\Tool\Schemifier;

/**
 * FieldMapperRegistry 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class FieldMapperRegistry 
{
	/**
	 * mappers 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mappers;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->mappers = array();
	}

	/**
	 * has 
	 * 
	 * @param mixed $src 
	 * @param mixed $dest 
	 * @access public
	 * @return void
	 */
	public function has($src, $dest)
	{
		if(!isset($this->mappers[$src]) || !isset($this->mappers[$src][$dest])) {
			return false;
		}

		return true;
	}

	/**
	 * get 
	 * 
	 * @param mixed $src 
	 * @param mixed $dest 
	 * @access public
	 * @return void
	 */
	public function get($src, $dest)
	{
		if(!isset($this->mappers[$src]) || !isset($this->mappers[$src][$dest])) {
			throw new \Exception('FieldMapper from "%s" to "%s" is not registered.');
		}

		return $this->mappers[$src][$dest];
	}

	/**
	 * set 
	 * 
	 * @param mixed $src 
	 * @param mixed $dest 
	 * @param Mapper $mapper 
	 * @access public
	 * @return void
	 */
	public function set($src, $dest, Mapper $mapper)
	{
		if(!isset($this->mappers[$src])) {
			$this->mappers[$src] = array();
		}

		$this->mappers[$src][$dest] = $mapper;

		return $this;
	}
}

