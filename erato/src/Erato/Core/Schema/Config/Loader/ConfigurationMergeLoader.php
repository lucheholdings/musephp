<?php
namespace Erato\Core\Schema\Config\Loader;

use Clio\Component\Pattern\Loader;

/**
 * ConfigurationMergeLoader 
 * 
 * @uses SequentialLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ConfigurationMergeLoader extends Loader\SequentialLoader 
{
    /**
     * load 
     * 
     * @param mixed $resource 
     * @param array $options 
     * @access public
     * @return void
     */
    public function load($resource, array $options = array())
    {
        $config = null;
        
        foreach($this as $loader) {
            try {
                $temp = $loader->load($resource, $options);
            } catch(Loader\Exception $ex) {
                // skip
                continue;
            }

            if($config) {
                $config = $config->merge($temp);
            } else {
                $config = $temp;
            }
        }

        if(!$config) {
            throw new Loader\Exception\InvalidResourceException(sprintf('Invalid Resource "%s"', (string)$resource));
        }

        return $config;
    }
}

