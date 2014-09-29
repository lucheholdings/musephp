<?php
namespace Clio\Component\Pce\FieldAccessor;

use Clio\Component\Pce\FieldAccessor\Mapping\ClassMapping;

/**
 * AbstractFieldAccessor 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFieldAccessor implements FieldAccessor
{
	/**
	 * classMapping 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $classMapping;

	/**
	 * options 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $options;

	/**
	 * __construct 
	 * 
	 * @param ClassMapping $classMapping 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(ClassMapping $classMapping, array $options = array())
	{
		$this->classMapping = $classMapping;
		$this->options = $options;
	}

    /**
     * Get options.
     *
     * @access public
     * @return options
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * Set options.
     *
     * @access public
     * @param options the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setOptions($options)
    {
        $this->options = $options;
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
}

