<?php
namespace Clio\Extra\Metadata\Cache;

use Clio\Component\Util\Execution\Invoker;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Injection\Injector;
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
	 * mappingInjector 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $mappingInjector;

	/**
	 * __construct 
	 * 
	 * @param Injector $mappingInjector 
	 * @access public
	 * @return void
	 */
	public function __construct(Injector $mappingInjector)
	{
		$this->mappingInjector = $mappingInjector;
	}

	/**
	 * {@inheritdoc}
	 */
	public function warmup($data)
	{
		if(!$data instanceof Metadata) {
			throw new \InvalidArgumentException(sprintf('Argument 0 of MetadataCacheWarmer::warmup has to be an instance of Metadata, but "%s" is given.', is_object($data) ? get_class($data) : gettype($data)));
		}
		
		return $this->doInject($data);
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
			$this->getMappingInjector()->inject($mapping);
		}

		return $metadata;
	}
    
    /**
     * getMappingInjector 
     * 
     * @access public
     * @return void
     */
    public function getMappingInjector()
    {
        return $this->mappingInjector;
    }
    
    /**
     * setMappingInjector 
     * 
     * @param mixed $mappingInjector 
     * @access public
     * @return void
     */
    public function setMappingInjector(Injector $mappingInjector)
    {
        $this->mappingInjector = $mappingInjector;
        return $this;
    }
}

