<?php
namespace Clio\Component\Pattern\Factory;

/**
 * TypedComponentFactory 
 * 
 * @uses ClassFactory
 * @uses TypedFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypedComponentFactory extends ClassFactory implements TypedFactory
{
	/**
	 * types 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $types;

	/**
	 * __construct 
	 * 
	 * @param array $classes 
	 * @access public
	 * @return void
	 */
	public function __construct(array $classes = array())
	{
		$this->types = array();
		foreach($classes as $type => $class) {
			$this->setTypedClass($type, $class);
		}
	}

	/**
	 * doCreate 
	 * 
	 * @param array $args 
	 * @access protected
	 * @return void
	 */
	protected function doCreate(array $args = array())
	{
		$type = array_shift($args);
		return $this->createByTypeArgs($type, $args);
	}

	/**
	 * createByType 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function createByType($type)
	{
		$args = func_get_args();
		array_shift($args);
		
		return $this->createByTypeArgs($type, $args);
	}

	/**
	 * createByTypeArgs 
	 * 
	 * @param mixed $type 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createByTypeArgs($type, array $args = array())
	{
		$args = $this->resolveArgs($args);

		return $this->createClass($this->getTypedClass($type), $args);
	}

	/**
	 * setTypedClass 
	 * 
	 * @param mixed $type 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function setTypedClass($type, $class)
	{
		if($class instanceof \ReflectionClass) {
			$this->types[$type] = $class;
		} else {
			$this->types[$type] = new \ReflectionClass($class);
		}

		return $this;
	}

	/**
	 * getTypedClass 
	 * 
	 * @param mixed $type 
	 * @access public
	 * @return void
	 */
	public function getTypedClass($type)
	{
		if(!isset($this->types[$type])) {
			throw new \InvalidArgumentException(sprintf('Type "%s" is not specified.', $type));
		}
		return $this->types[$type];
	}
}

