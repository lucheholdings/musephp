<?php
namespace Clio\Component\Pce\FieldAccessor\Builder;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;
use Clio\Component\Pce\FieldAccessor\PropertyFieldCollectionAccessor;
use Clio\Component\Pce\FieldAccessor\Factory\FieldAccessorFactory;

use Clio\Component\Pce\FieldAccessor\ChainFieldAccessor;
/**
 * FieldAccessorBuilder 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class LayerFieldAccessorBuilder implements FieldAccessorBuilder
{
	/**
	 * ignoreFields 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $ignoreFields;

	/**
	 * layerFactories 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $layerFactories = array();

	/**
	 * classMapping 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMapping;

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function build()
	{
		$rootAccessor = $accessor = null;

		foreach($this->getLayerFactories() as $factory) {
			$newAccessor = new ChainFieldAccessor($factory->createFieldAccessor($this->classMapping));

			if($accessor) {
				$accessor->setChainedAccessor($newAccessor);
			} else {
				$rootAccessor = $newAccessor;
			}
			$accessor = $newAccessor;
		}

		return $rootAccessor;
	}
    
    /**
     * Get ignoreFields.
     *
     * @access public
     * @return ignoreFields
     */
    public function getIgnoreFields()
    {
        return $this->ignoreFields;
    }
    
    /**
     * Set ignoreFields.
     *
     * @access public
     * @param ignoreFields the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setIgnoreFields($ignoreFields)
    {
        $this->ignoreFields = $ignoreFields;
        return $this;
    }
    
    /**
     * Get classMapping.
     *
     * @access public
     * @return classMapping
     */
    public function getClassMapping()
    {
        return $this->classMapping;
    }
    
    /**
     * Set classMapping.
     *
     * @access public
     * @param classMapping the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setClassMapping(ClassMapping $classMapping)
    {
        $this->classMapping = $classMapping;
        return $this;
    }

	/**
	 * addLayerFactory 
	 * 
	 * @param FieldAccessorFactory $factory 
	 * @param int $priority 
	 * @access public
	 * @return void
	 */
	public function addLayerFactory(FieldAccessorFactory $factory, $priority = 0)
	{
		if(!isset($this->layerFactories[$priority])) {
			$this->layerFactories[$priority] = array();
		}

		$this->layerFactories[$priority][] = $factory;

		return $this;
	}
    
    /**
     * Get layerFactories.
     *
     * @access public
     * @return layerFactories
     */
    public function getLayerFactories()
    {
		// order by priority
        krsort($this->layerFactories);
			
		$flatten = array();
		// make the array flatten
		array_walk($this->layerFactories, function($value) use (&$flatten) {
			$flatten = array_merge($flatten, $value);
		});

		return $flatten;
    }
}
