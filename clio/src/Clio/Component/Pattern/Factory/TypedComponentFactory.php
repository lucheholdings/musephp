<?php
namespace Clio\Component\Pattern\Factory;

class TypedComponentFactory implements Factory, TypedFactory
{
	private $types;

	public function __construct(array $classes)
	{
		$this->types = array();
		foreach($classes as $type => $class) {
			$this->setTypedClass($type, $class);
		}
	}

	public function createByType($type)
	{
		$args = func_get_args();
		
		return $this->doCreate($type, array_slice($args, 1));
	}

	public function create()
	{
		$args = func_get_args();
		
		return $this->doCreate($args[0], array_slice($args, 1));
	}

	public function createByTypeArgs($type, array $args = array())
	{
		return $this->doCreate($type, $args);
	}

	public function createArgs(array $args = array())
	{
		return $this->doCreate($type, $args);
	}

	protected function doCreate($type, array $args)
	{
		$args = $this->resolveArguments($args);

		return $this->constructInstance($this->getTypedClass($type), $args);
	}

	protected function constructInstance(\ReflectionClass $class, array $args)
	{
		return $class->newInstanceArgs($args);
	}

	public function setTypedClass($type, $class)
	{
		if($class instanceof \ReflectionClass) {
			$this->types[$type] = $class;
		} else {
			$this->types[$type] = new \ReflectionClass($class);
		}

		return $this;
	}

	public function getTypedClass($type)
	{
		if(!isset($this->types[$type])) {
			throw new \InvalidArgumentException(sprintf('Type "%s" is not specified.', $type));
		}
		return $this->types[$type];
	}
}

