<?php
namespace Clio\Component\Util\Metadata\Mapping;

use Clio\Component\Util\Metadata\Mapping\Factory\FactoryCollection;
use Clio\Component\Util\Container\Validator\ClassValidator;

/**
 * LazyMappingCollection 
 * 
 * @uses Collection
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LazyMappingCollection extends MappingCollection
{
	private $factoryCollection;

	/**
	 * __construct 
	 * 
	 * @param FactoryCollection $factoryCollection 
	 * @access public
	 * @return void
	 */
	public function __construct(FactoryCollection $factoryCollection)
	{
		parent::__construct();

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
		if(parent::hasKey($name)) {
			if(!$this->getFactoryCollection()->hasFactory($name)) {
				throw new \InvalidArgumentException(sprintf('Mapping "%s" is not exists with Metadata "%s"', $name, $metadata));
			}

			$this->set($name, $this->getFactoryCollection()->createTypeMapping($metadata, $name));
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
		return parent::hasKey($name) || $this->getFactoryCollection()->hasFactory($name);
	}
    
    /**
     * getFactoryCollection 
     * 
     * @access public
     * @return void
     */
    public function getFactoryCollection()
    {
        return $this->factoryCollection;
    }
    
    /**
     * setFactoryCollection 
     * 
     * @param mixed $factoryCollection 
     * @access public
     * @return void
     */
    public function setFactoryCollection($factoryCollection)
    {
        $this->factoryCollection = $factoryCollection;
        return $this;
    }
}

