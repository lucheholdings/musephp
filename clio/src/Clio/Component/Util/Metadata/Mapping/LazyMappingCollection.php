<?php
namespace Clio\Component\Util\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\Factory\Collection as FactoryCollection;
use Clio\Component\Util\Validator\ClassValidator;

/**
 * LazyMappingCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LazyMappingCollection extends Collection
{
	private $metadata;

	private $factoryCollection;

	/**
	 * __construct 
	 * 
	 * @param FactoryCollection $factoryCollection 
	 * @access public
	 * @return void
	 */
	public function __construct($metadata, FactoryCollection $factoryCollection = null)
	{
		parent::__construct();

		$this->metadata = $metadata;
		$this->factoryCollection = $factoryCollection;
	}

	/**
	 * initContainer 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function initContainer()
	{
		$this->setValueValidator(new ClassValidator('Clio\Component\Util\Metadata\Mapping'));
	}

	/**
	 * get 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function get($name)
	{
		if(!parent::hasKey($name)) {
			$metadata = $this->getMetadata();
			if(!$this->getFactoryCollection()->hasFactory($name)) {
				throw new \InvalidArgumentException(sprintf('Mapping "%s" is not exists with Metadata "%s"', $name, $metadata));
			}

			$factory = $this->getFactoryCollection()->getFactory($name);
			if($factory->isSupportedMetadata($metadata)) {
				$this->set($name, $this->createMapping($metadata));
			} else {
				throw new \Exception(sprintf('Metadata dose not support Mapping "%s"', $name));
			}
		}

		return parent::get($name);
	}

	/**
	 * has 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasKey($name)
	{
		return parent::hasKey($name) || ($this->getFactoryCollection()->hasFactory($name) && $this->getFactoryCollection()->getFactory($name)->isSupportedMetadata($this->getMetadata()));
	}
    
    /**
     * getFactoryCollection 
     * 
     * @access public
     * @return void
     */
    public function getFactoryCollection()
    {
		if(!$this->factoryCollection) {
			throw new \RuntimeException(sprintf('FactoryCollection is not initialized yet.'));
		}
        return $this->factoryCollection;
    }
    
    /**
     * setFactoryCollection 
     * 
     * @param mixed $factoryCollection 
     * @access public
     * @return void
     */
    public function setFactoryCollection(FactoryCollection $factoryCollection)
    {
        $this->factoryCollection = $factoryCollection;
        return $this;
    }
    
    public function getMetadata()
    {
        return $this->metadata;
    }
    
    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
        return $this;
    }
}

