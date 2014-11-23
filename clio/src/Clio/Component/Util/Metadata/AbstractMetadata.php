<?php
namespace Clio\Component\Util\Metadata;

use Clio\Component\Util\Metadata\Mapping\Collection as MappingCollection;

/**
 * AbstactMetadata 
 * 
 * @uses Metadata
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMetadata implements Metadata
{
	/**
	 * {@inheritdoc}
	 */
	private $mappings; 

	/**
	 * {@inheritdoc}
	 */
	public function clean()
	{
		foreach($this->getMappings() as $mapping) {
			$mapping->clean();
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return $this->getName();
	}
    
    /**
     * {@inheritdoc}
     */
    public function getMappings()
    {
		if(!$this->mappings) {
			$this->mappings = new MappingCollection();
		}
        return $this->mappings;
    }
    
    /**
     * {@inheritdoc}
     */
    public function setMappings(MappingCollection $mappings)
    {
		$this->mappings = $mappings;

		foreach($mappings as $mapping) {
			$mapping->setMetadata($this);
		}
        return $this;
    }

	/**
	 * {@inheritdoc}
	 */
	public function hasMapping($name)
	{
		return $this->getMappings()->hasMapping($name);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMapping($name)
	{
		return $this->getMappings()->getMapping($name);
	}

	/**
	 * {@inheritdoc}
	 */
	public function setMapping($name, Mapping $mapping)
	{
		$this->getMappings()->setMapping($name, $mapping);
		$mapping->setMetadata($this);
		return $this;
	}
}

