<?php
namespace Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;

use Calliope\Bridge\SymfonyComponents\Filter\ListenerFactory;

/**
 * AbstractFactory 
 * 
 * @uses ListenerFactory
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractFactory implements ListenerFactory
{
	/**
	 * defaultOptions 
	 * 
	 * @var mixed
	 * @access private
	 */
	private $defaultOptions;

	/**
	 * __construct 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function __construct(array $options = array())
	{
		$this->defaultOptions = $options;
	}

	/**
	 * getMergedOptions 
	 * 
	 * @param array $options 
	 * @access public
	 * @return void
	 */
	public function getMergedOptions(array $options = array())
	{
		return array_merge($this->defaultOptions, $options);
	}
    
    /**
     * getDefaultOptions 
     * 
     * @access public
     * @return void
     */
    public function getDefaultOptions()
    {
        return $this->defaultOptions;
    }
    
    /**
     * setDefaultOptions 
     * 
     * @param mixed $defaultOptions 
     * @access public
     * @return void
     */
    public function setDefaultOptions(array $defaultOptions)
    {
        $this->defaultOptions = $defaultOptions;
        return $this;
    }
}
