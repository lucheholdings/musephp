<?php
namespace Clio\Extra\Metadata\Cache;

use Clio\Component\Util\Execution\Invoker;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Injection\InjectorMap;
use Clio\Extra\Registry\Loader\CacheWarmer;


/**
 * MetadataCacheWarmer
 * 
 * @uses Invoker
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataCacheWarmer implements CacheWarmer 
{
	/**
	 * mappingInjectors 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mappingInjectors;

	/**
	 * __construct 
	 * 
	 * @param Injector $mappingInjectors 
	 * @access public
	 * @return void
	 */
	public function __construct(InjectorMap $mappingInjectors)
	{
		$this->mappingInjectors = $mappingInjectors;
	}

	/**
	 * {@inheritdoc}
	 */
	public function warmup($metadata)
	{
		if(!$metadata instanceof Metadata) {
			throw new \InvalidArgumentException(sprintf('Argument 0 of MetadataCacheWarmer::warmup has to be an instance of Metadata, but "%s" is given.', is_object($metadata) ? get_class($metadata) : gettype($metadata)));
		}
		
		$metadata = $this->doInject($metadata);

		foreach($metadata->getFields() as $field) {
			$this->doInject($field);
		}
		return $metadata;
	}

	/**
	 * doInject 
	 * 
	 * @param Metadata $metadata 
	 * @access protected
	 * @return void
	 */
	protected function doInject(Metadata $metadata)
	{
		foreach($metadata->getMappings() as $mapping) {
			if($this->getMappingInjectors()->has($mapping->getName())) {
				$this->getMappingInjectors()->get($mapping->getName())->inject($mapping);
			}
		}

		return $metadata;
	}
    
    /**
     * getMappingInjectors 
     * 
     * @access public
     * @return void
     */
    public function getMappingInjectors()
    {
        return $this->mappingInjectors;
    }
    
    /**
     * setMappingInjectors 
     * 
     * @param mixed $mappingInjectors 
     * @access public
     * @return void
     */
    public function setMappingInjectors(InjectorMap $mappingInjectors)
    {
        $this->mappingInjectors = $mappingInjectors;
        return $this;
    }
}

