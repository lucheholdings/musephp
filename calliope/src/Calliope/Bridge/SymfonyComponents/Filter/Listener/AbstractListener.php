<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\Listener;

/**
 * AbstractListener 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractListener 
{
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
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->options = $options;
	}
    
    /**
     * getOptions 
     * 
     * @access public
     * @return void
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * setOptions 
     * 
     * @param array $options 
     * @access public
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
        return $this;
    }

	/**
	 * getOption 
	 * 
	 * @param mixed $name 
	 * @param mixed $default 
	 * @access public
	 * @return void
	 */
	public function getOption($name, $default = null)
	{
		return isset($this->options[$name]) 
			? $this->options[$name]
			: $default
		;
	}

	/**
	 * hasOption 
	 * 
	 * @param mixed $name 
	 * @access public
	 * @return void
	 */
	public function hasOption($name)
	{
		return isset($this->options[$name]);
	}

	/**
	 * setOption 
	 * 
	 * @param mixed $name 
	 * @param mixed $value 
	 * @access public
	 * @return void
	 */
	public function setOption($name, $value)
	{
		$this->options[$name] = $value;
	}

}
