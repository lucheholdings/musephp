<?php
namespace Calliope\Framework\Core\Filter\Factory;


use Calliope\Framework\Core\Filter\Factory as FilterFactory;

/**
 * TypedFilterFactory 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class TypedFilterFactory 
{
	/**
	 * factories 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $factories;

	/**
	 * setFilterFactory 
	 * 
	 * @param mixed $type 
	 * @param FilterFactory $factory 
	 * @access public
	 * @return void
	 */
	public function setFilterFactory($type, FilterFactory $factory)
	{
		$this->factories[$type] = $factory;

		return $this;
	}
    
    /**
     * getFactories 
     * 
     * @access public
     * @return void
     */
    public function getFactories()
    {
        return $this->factories;
    }
    
    /**
     * setFactories 
     * 
     * @param mixed $factories 
     * @access public
     * @return void
     */
    public function setFactories($factories)
    {
        $this->factories = $factories;
        return $this;
    }

	/**
	 * createFilter 
	 * 
	 * @param mixed $type 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function createFilter($type, array $options = array())
	{
		if(!isset($this->factories[$type])) {
			throw new \Exception(sprintf('FilterFactory for type "%s" is not registered.', $type));
		}

		$factory = $this->factories[$type];

		return $factory->createFilter($options);
	}
}

