<?php
namespace Clio\Component\Util\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping;
use Clio\Component\Util\Container\Map\Map;
use Clio\Component\Util\Container\Storage\ValidatableStorage;
use Clio\Component\Util\Validator\ClassValidator;

/**
 * MappingCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MappingCollection extends Map 
{
	/**
	 * initContainer 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initContainer(array $values)
	{
		parent::initContainer($values);

		if(!$this->getStorage() instanceof ValidatableStorage) {
			$this->setStorage(new ValidatableStorage($this->getStorage()));
		}
		$this->getStorage()->setValueValidator(new ClassValidator('Clio\Component\Util\Metadata\Mapping'));
	}

	/**
	 * hasMapping 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasMapping($name)
	{
		return $this->has($name);
	}

	/**
	 * getMapping 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function getMapping($name)
	{
		return $this->get($name);
	}

	/**
	 * setMapping 
	 * 
	 * @param mixed $name 
	 * @param Mapping $mapping 
	 * @access public
	 * @return void
	 */
	public function setMapping($name, Mapping $mapping)
	{
		return $this->set($name, $mapping);
	}

	public function addMapping(Mapping $mapping)
	{
		$this->set($mapping->getName(), $mapping);
	}
}

