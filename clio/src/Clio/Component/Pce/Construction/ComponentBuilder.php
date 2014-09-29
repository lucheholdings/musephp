<?php
namespace Clio\Component\Pce\Construction;

/**
 * ComponentBuilder 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ComponentBuilder implements Builder
{
	/**
	 * _default 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_default;

	/**
	 * componentFactory 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $componentFactory;

	/**
	 * constructorArgs 
	 * 
	 * @var array
	 * @access private
	 */
	private $constructorArgs = array();

	/**
	 * __construct 
	 * 
	 * @param mixed $factory 
	 * @access public
	 * @return void
	 */
	public function __construct($factory)
	{
		if($factory instanceof Factory) {
			$this->componentFactory = $factory;
		} else {
			$this->componentFactory = new ComponentFactory($factory);
		}
	}

	/**
	 * build 
	 * 
	 * @access public
	 * @return void
	 */
	public function build()
	{
		if($this->_default) {
			$component = $this->_default;
		} else {
			$component = $this->getComponentFactory()->createArgs($this->getConstructorArgs());
		}

		$this->doBuild($component);

		return $component;
	}

	/**
	 * doBuild 
	 * 
	 * @param mixed $component 
	 * @access protected
	 * @return void
	 */
	protected function doBuild($component)
	{
		// Inherit iff you need 
	}
    
    /**
     * Get componentFactory.
     *
     * @access public
     * @return componentFactory
     */
    public function getComponentFactory()
    {
        return $this->componentFactory;
    }
    
    /**
     * Set componentFactory.
     *
     * @access public
     * @param componentFactory the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setComponentFactory($componentFactory)
    {
        $this->componentFactory = $componentFactory;
        return $this;
    }
    
    /**
     * Get constructorArgs.
     *
     * @access public
     * @return constructorArgs
     */
    protected function getConstructorArgs()
    {
        return $this->constructorArgs;
    }
    
    /**
     * Set constructorArgs.
     *
     * @access public
     * @param constructorArgs the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setConstructorArgs(array $constructorArgs)
    {
        $this->constructorArgs = $constructorArgs;
        return $this;
    }
    
    /**
     * Get default.
     *
     * @access public
     * @return default
     */
    public function getDefault()
    {
        return $this->_default;
    }
    
    /**
     * Set default.
     *
     * @access public
     * @param default the value to set.
     * @return mixed Class instance for method-chanin.
     */
    public function setDefault($default)
    {
        $this->_default = $default;
        return $this;
    }
}

