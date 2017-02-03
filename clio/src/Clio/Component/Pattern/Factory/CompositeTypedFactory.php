<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Component\Pattern\Factory;

class CompositeTypedFactory implements TypedFactory 
{
	protected $factories = array();

	public function __construct(array $facotires = array())
	{
		$this->factories = array();
	}

	public function has($type)
	{
		return isset($this->factories[(string)$type]);
	}

	public function add($type, $factory)
	{
		$this->factories[(string)$type] = $factory;
		return $this;
	}

	public function remove($type)
	{
		if(isset($this->factories[(string)$type])) {
			unset($this->factories[(string)$type]);
		}
		return $this;
	}

	public function createByType($type)
	{
		$args = func_get_args();
		$type = array_shift($args);

		return $this->doCreateByType($type, $args);
	}

	public function createByTypeArgs($type, array $args = array())
	{
		return $this->doCreateByType($type, $args);
	}

	protected function doCreateByType($type, array $args)
	{
		$factory = $this->getFactory((string)$type);
		
		if($factory instanceof Factory) {
			return $factory->createArgs($args);
		} else {
			throw new \RuntimeException(sprintf('Failed to create for type "%s".', $type));
		}
	}

	public function getFactory($type)
	{
		if(isset($this->factories[$type])) {
			return $this->factories[$type];
		} else {
			throw new \InvalidArgumentException(sprintf('Unknown type "%s" to create.', (string)$type));
		}
	}
}

