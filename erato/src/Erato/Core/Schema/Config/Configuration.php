<?php
namespace Erato\Core\Schema\Config;

interface Configuration
{
    /**
     * inherit 
     * 
     * @param Configuration $config 
     * @access public
     * @return void
     */
    function inherit(Configuration $config);

    /**
     * merge 
     * 
     * @param Configuration $config 
     * @access public
     * @return void
     */
    function merge(Configuration $config);
}

