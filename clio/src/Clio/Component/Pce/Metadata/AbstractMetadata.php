<?php
namespace Clio\Component\Pce\Metadata;

/**
 * AbstractMetadata 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractMetadata implements 
	Metadata,
	MappableMetadata
{
	/**
	 * reflector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $reflector;

	/**
	 * mappings 
	 * 
	 * @var array
	 * @access protected
	 */
	protected $mappings = array();

	/**
	 * mappingFactory 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $mappingFactory = null;

	/**
	 * __construct 
	 * 
	 * @param \Reflector $reflector 
	 * @access public
	 * @return void
	 */
	public function __construct(\Reflector $reflector)
	{
		$this->reflector = $reflector;
	}

    /**
     * Get mappings.
     *
     * @access public
     * @return mappings
     */
    public function getMappings()
    {
        return $this->mappings;
    }

	/**
	 * hasMapping
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function hasMapping($alias)
	{
		try {
			return (bool)$this->getMapping($alias);
		} catch(\Exception $ex) {
			throw $ex;
			return false;
		}
	}

	/**
	 * getMapping 
	 * 
	 * @param mixed $alias 
	 * @access public
	 * @return void
	 */
	public function getMapping($alias)
	{
		if(!isset($this->mappings[$alias])) {
			throw new \RuntimeException(sprintf('Metadata dose not have "%s" mappning', $alias));
		} else if($this->mappings[$alias] instanceof ProxyMapping) {
			$this->mappings[$alias] = $this->mappings[$alias]->getMapping();
		}

		return $this->mappings[$alias];
	}
    
    /**
     * Set mappings.
     *
     * @access public
     * @param mappings the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setMapping($alias, Mapping $mapping)
    {
        $this->mappings[$alias] = $mapping;
		$mapping->setMetadata($this);
        return $this;
    }

	public function setMappings(array $mappings)
	{
		foreach($mappings as $alias => $mapping) {
			$this->setMapping($alias, $mapping);
		}

		return $this;
	}
    
    /**
     * Get reflector.
     *
     * @access public
     * @return reflector
     */
    public function getReflector()
    {
        return $this->reflector;
    }
    
    /**
     * Set reflector.
     *
     * @access public
     * @param reflector the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setReflector($reflector)
    {
        $this->reflector = $reflector;
        return $this;
    }
    
    public function getMappingFactory()
    {
        return $this->mappingFactory;
    }
    
    public function setMappingFactory($mappingFactory)
    {
        $this->mappingFactory = $mappingFactory;
        return $this;
    }
}

