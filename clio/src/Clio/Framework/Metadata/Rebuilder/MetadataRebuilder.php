<?php
namespace Clio\Framework\Metadata\Rebuilder;

use Clio\Component\Util\Execution\Invoker;
use Clio\Component\Util\Metadata\Metadata;
use Clio\Component\Util\Injection\Injector;


/**
 * MetadataRebuilder 
 * 
 * @uses Invoker
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataRebuilder extends Invoker 
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
	protected function doInvokeArgs(array $args)
	{
		$metadata = array_shift($args);

		if(!$metadata instanceof Metadata) {
			throw new \InvalidArgumentException(sprintf('Argument 0 of MetadataRebuilder::doInvokeArgs has to be an instance of Metadata, but "%s" is given.', is_object($metadata) ? get_class($metadata) : gettype($metadata)));
		}
		
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

