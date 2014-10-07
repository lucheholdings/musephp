<?php
namespace Clio\Component\Tool\Schemifier;

use Clio\Component\Tool\ArrayTool\KeyMapper;

/**
 * AbstractSchemifier 
 * 
 * @uses Schemifier
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemifier implements Schemifier 
{
	/**
	 * schemeClass 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $schemeClass;

	/**
	 * maps 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $fieldMapperRegistry;

	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct(\ReflectionClass $schemeClass, FieldMapperRegistry $fieldMapperRegistry = null)
	{
		$this->schemeClass = $schemeClass;

		$this->fieldMapperRegistry = $fieldMapperRegistry;
	}
    
    /**
     * Set schemeClass.
     *
     * @access public
     * @param schemeClass the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setSchemeClass(\ReflectionClass $schemeClass)
    {
        $this->schemeClass = $schemeClass;
        return $this;
    }

	/**
	 * getSchemeClass 
	 * 
	 * @access public
	 * @return void
	 */
	public function getSchemeClass()
	{
		return $this->schemeClass;
	}
    
    public function getFieldMapperRegistry()
    {
		if(!$this->fieldMapperRegistry) {
			$this->fieldMapperRegistry = new FieldMapperRegistry();
		}
        return $this->fieldMapperRegistry;
    }
    
    public function setFieldMapperRegistry(FieldMapperRegistry $fieldMapperRegistry)
    {
        $this->fieldMapperRegistry = $fieldMapperRegistry;
        return $this;
    }

	public function hasDefaultFieldMapper($resourceType)
	{
		return $this->getFieldMapperRegistry()->has($resourceType, $this->getSchemeClass());
	}

	public function getDefaultFieldMapper($resourceType)
	{
		return $this->getFieldMapperRegistry()->get($resourceType, $this->getSchemeClass());
	}

	public function createFieldMapperFor($resource, array $maps)
	{
		$mapper = null;

		if(is_array($resource) && $this->hasDefaultFieldMapper('array')) {
			$mapper = $this->getDefaultFieldMapper('array');
		} else if(is_object($resource) && $this->hasDefaultFieldMapper(get_class($resource))) {
			$mapper = $this->getDefaultFieldMapper(get_class($resource));
		} 

		//
		if(!empty($maps)) {
			if($mapper) {
				$mapper = clone $mapper;
				foreach($maps as $src => $dest) {
					$mapper->set($src, $dest);
				}
			} else {
				$mapper = new KeyMapper($maps);
			}
		} else if(!$mapper) {
			// Create Empty Mapper
			$mapper = new KeyMapper();
		}

		return $mapper;
	}
}

