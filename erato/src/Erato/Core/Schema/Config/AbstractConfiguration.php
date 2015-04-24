<?php
namespace Erato\Core\Schema\Config;

/**
 * AbstractConfiguration 
 * 
 * @uses Configuration
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class AbstractConfiguration implements Configuration
{
    /**
     * options 
     * 
     * @var array
     * @access public
     */
    public $options = array();

    /**
     * mappings 
     * 
     * @var array
     * @access public
     */
    public $mappings = array(); 
    
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
     * getMappings 
     * 
     * @access public
     * @return void
     */
    public function getMappings()
    {
        return $this->mappings;
    }
    
    /**
     * setMappings 
     * 
     * @param array $mappings 
     * @access public
     * @return void
     */
    public function setMappings(array $mappings)
    {
        $this->mappings = $mappings;
        return $this;
    }

    /**
     * merge 
     * 
     * @param mixed $config 
     * @access public
     * @return void
     */
    public function merge(Configuration $config)
    {
        $this->options = array_merge($this->options, $config->options);
        $this->mappings = array_replace($this->mappngs, $config->mappings);

        return $this;
    }

    /**
     * inherit 
     * 
     * @param mixed $config 
     * @access public
     * @return void
     */
    public function inherit(Configuration $config)
    {
        $this->options = array_merge($config->options, $this->options);
        $this->mappings = array_replace($config->mappings, $this->mappings);

        return $this;
    }
}

