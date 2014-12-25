<?php
namespace Clio\Component\Tool\Schemifier;

use Clio\Component\Tool\ArrayTool\Mapper;

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
		$src = $this->convertType($src);
		$dest = $this->convertType($dest);

		if(isset($this->mappers[$src]) && isset($this->mappers[$src][$dest])) {
			return true;
		}

		return false;
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
		$src = $this->convertType($src);
		$dest = $this->convertType($dest);

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
	public function set($src, $dest, Mapper\Mapper $mapper)
	{
		$src = $this->convertType($src);
		$dest = $this->convertType($dest);

		// Direct
		if(!isset($this->mappers[$src])) {
			$this->mappers[$src] = array();
		}
		$this->mappers[$src][$dest] = $mapper;

		// Indirect
		if(!$this->has($dest, $src)) {
			if(!isset($this->mappers[$dest])) {
				$this->mappers[$dest] = array();
			}
			$this->mappers[$dest][$src] = new Mapper\InverseMapper($mapper);
		}

		return $this;
	}

	/**
	 * addRegister 
	 * 
	 * @param FieldMapperRegister $register 
	 * @access public
	 * @return void
	 */
	public function addRegister(FieldMapperRegister $register)
	{
		$this->set($register->getSource(), $register->getDestination(), $register->getMapper());

		return $this;
	}

	protected function convertType($type)
	{
		if(is_string($type)) {
			return $type;	
		} else if(is_array($type)) {
			return 'array';
		} else if(is_object($type)) {
			if($type instanceof \ReflectionClass) {
				return $type->getName();
			} else {
				return get_class($type);
			}
		} else {
			return gettype($type);
		}
	}
}

