<?php
namespace Clio\Component\Pce\Metadata;

class AliasedMappingFactoryCollection 
{
	private $factories;

	public function __construct(array $factories = array())
	{
		$this->factories = $factories;
	}

	public function createMappings(Metadata $metadata) 
	{
		foreach($this->getFactories() as $alias => $factory) {
			$mapping = $factory->createMapping($metadata);

			if($mapping) {
				$mappings[$alias] = $mapping;
			}
		}
		return $mappings;
	}

	public function createMappingForAlias($alias, Metadata $metadata)
	{
		$factory = $this->getFactory($alias);

		return $factory->createMapping($metadata);
	}

	public function getFactory($alias)
	{
		if(!array_key_exists($alias, $this->factories)) {
			throw new \InvalidArgumentException(sprintf('Factory "%s" is not exists', $alias));
		}
		return $this->factories[$alias];
	}
    
    public function getFactories()
    {
        return $this->factories;
    }
    
    public function setFactories($factories)
    {
        $this->factories = $factories;
        return $this;
    }

	public function addFactory($factory, $alias = null)
	{
		$alias = $alias ?: $factory->getAlias();

		if(!$alias) {
			throw new \Exception('Alias has to be configured for MappingFactory.');
		}
		$this->factories[$alias ?: $factory->getAlias()] = $factory;
		return $this;
	}
}

