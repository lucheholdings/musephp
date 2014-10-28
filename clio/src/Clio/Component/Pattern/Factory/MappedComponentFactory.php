<?php
namespace Clio\Component\Pattern\Factory;

/**
 * MappedComponentFactory 
 * 
 * @uses ClassFactory
 * @uses MappedFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MappedComponentFactory extends ClassFactory implements MappedFactory
{
	/**
	 * classes 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classes;

	/**
	 * __construct 
	 * 
	 * @param array $classes 
	 * @access public
	 * @return void
	 */
	public function __construct(array $classes = array())
	{
		$this->classes = array();

		parent::__construct();

		foreach($classes as $key => $class) {
			$this->setMappedClass($key, $class);
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
		$key = array_shift($args);
		return $this->createByKeyArgs($key, $args);
	}

	/**
	 * createByKey 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function createByKey()
	{
		$args = func_get_args();
		$key = array_shift($args);
		
		return $this->createByKeyArgs($key, $args);
	}

	/**
	 * createByKeyArgs 
	 * 
	 * @param mixed $key 
	 * @param array $args 
	 * @access public
	 * @return void
	 */
	public function createByKeyArgs($key, array $args = array())
	{
		$args = $this->resolveKeyArgs($key, $args);

		return $this->createClassArgs($this->getMappedClass($key), $args);
	}

	/**
	 * setMappedClass 
	 * 
	 * @param mixed $key 
	 * @param mixed $class 
	 * @access public
	 * @return void
	 */
	public function setMappedClass($key, $class)
	{
		if($class instanceof \ReflectionClass) {
			$this->classes[$key] = $class;
		} else {
			$this->classes[$key] = new \ReflectionClass($class);
		}

		return $this;
	}

	/**
	 * getMappedClass 
	 * 
	 * @param mixed $key 
	 * @access public
	 * @return void
	 */
	public function getMappedClass($key)
	{
		if(!isset($this->classes[$key])) {
			throw new \InvalidArgumentException(sprintf('Type "%s" is not specified.', $key));
		}
		return $this->classes[$key];
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedFactory(array $args = array())
	{
		return $this->isSupportedKeyArgs(array_shift($args), $args);
	}

	/**
	 * {@inheritdoc}
	 */
	public function isSupportedKeyArgs($key, array $args = array())
	{
		return array_key_exists($this->classes[$key]);
	}

	protected function resolveKeyArgs($key, array $args = array())
	{
		return $args;
	}
}

