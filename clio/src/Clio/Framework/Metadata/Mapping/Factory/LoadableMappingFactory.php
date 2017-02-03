<?php
namespace Clio\Framework\Metadata\Mapping\Factory;

use Clio\Component\Pce\Metadata\Metadata;
use Clio\Framework\Metadata\Mapping\Loader\MappingLoaderFactory;

/**
 * LoadableMappingFactory 
 *   LoadableMappingFactory is a MappingFactory with 
 *   loading resource.
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class LoadableMappingFactory implements MappingFactory
{
	private $loaderFactory = null;

	/**
	 * __construct 
	 * 
	 * @param MappingLoader $loader 
	 * @access public
	 * @return void
	 */
	public function __construct(MappingLoaderFactory $loaderFactory = null)
	{
		$this->loaderFactory = $loaderFactory;
	}

	/**
	 * createMapping 
	 * 
	 * @param Metadata $metadata 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createMapping(Metadata $metadata, array $options = array())
	{
		$mapping = null;

		if($this->isSupportedMetadata($metadata)) {
			// try load
			$mapping = $this->doLoadMapping($this->createLoader($metadata));
		}

		return $mapping;
	}

	/**
	 * isSupportedMetadata 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return true;
	}
    
    /**
     * Get loaderFactory.
     *
     * @access public
     * @return loaderFactory
     */
    public function getLoaderFactory()
    {
        return $this->loaderFactory;
    }
    
    /**
     * Set loaderFactory.
     *
     * @access public
     * @param loaderFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setLoaderFactory($loaderFactory)
    {
        $this->loaderFactory = $loaderFactory;
        return $this;
    }

	/**
	 * createLoader 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function createLoader(Metadata $metadata)
	{
		return $this->loaderFactory->createLoader($metadata);
	}
}

