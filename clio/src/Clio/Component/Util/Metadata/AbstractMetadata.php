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
     * name 
     * 
     * @var mixed
     * @access private
     */
    private $name;

    /**
     * parent 
     *   If inherited metadata, parent will be setted.
     *   Otherwise null.
     * @var mixed
     * @access private
     */
    private $parent;

	/**
	 * {@inheritdoc}
	 */
	private $mappings; 

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options = array();

    /**
     * __construct 
     * 
     * @param mixed $name 
     * @param array $mappings 
     * @access public
     * @return void
     */
    public function __construct($name, array $mappings = array(), array $options = array(), $parent =  null)
    {
        $this->name = $name;
        $this->mappings = $mappings;
        $this->options = $options;
        $this->parent = $parent; 
    }

    /**
     * getName 
     * 
     * @access public
     * @return void
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * setName 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getMappings($includeParent = true)
    {
		if(!$this->mappings) {
			$this->mappings = new MappingCollection();
		}

        //if($includeParent && $this->getParent()) {
        //    return $this->mappings->inherit($this->getParent()->getMappings());
        //}

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
	public function hasMapping($name, $includeParent = true)
	{
        return $this->getMappings($includeParent)->hasMapping($name);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMapping($name, $includeParent = true)
	{
        if($this->hasMapping($name, false)) {
            return $this->getMappings(false)->getMapping($name);
        } else if($includeParent && $this->hasParent()) {
            return $this->getParent()->getMapping($name);
        } else {
            throw new \RuntimeException(sprintf('Mapping "%s" is not exists', $name));
        }
	}

    public function addMapping(Mapping $mapping)
    {
        $this->getMappings(false)->setMapping($mapping->getName(), $mapping);
        $mapping->setMetadata($this);
        return $this;
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
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     * 
     * @param array $options 
     * @access public
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * hasOption 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function hasOption($name)
	{
		return array_key_exists($name, $this->options);
	}

    /**
     * getOption 
     * 
     * @param mixed $name 
     * @param mixed $default 
     * @access public
     * @return void
     */
	public function getOption($name, $default = null)
	{
		return array_key_exists($name, $this->options) ? $this->options[$name] : $default;
	}

    /**
     * setOption 
     * 
     * @param mixed $name 
     * @param mixed $value 
     * @access public
     * @return void
     */
	public function setOption($name, $value)
	{
		$this->options[$name] = $value;
		return $this;
	}

    public function addOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function hasParent()
    {
        return (bool)$this->parent;
    }
    
    public function getParent()
    {
        if($this->parent && (!$this->parent instanceof Schema)) {
            throw new \RuntimeException('Parent is not initialized yet.');
        }
        return $this->parent;
    }
    
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function getParentName()
    {
        return (string)$this->parent;
    }

	/**
	 * {@inheritdoc}
	 */
	public function __toString()
	{
		return $this->getName();
	}
}

