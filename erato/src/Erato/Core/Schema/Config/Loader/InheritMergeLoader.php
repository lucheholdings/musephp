<?php
namespace Erato\Core\Schema\Config\Loader;

use Clio\Component\Pattern\Loader;

/**
 * InheritMergeLoader 
 *   Loader to merge ancestor configuration recursively 
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class InheritMergeLoader extends Loader\ProxyLoader
{
    /**
     * load 
     *   Recursively load the ancestor of resource and merge the configuration. 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function load($resource)
    {
        $loaded = $this->getLoader()->load($resource);
        if($loaded->hasParent()) {
            // Load parent resource 
            try {
                $parent = $this->load($loaded->getParent());
                $loaded = $loaded->inherit($parent);
            } catch(Loader\Exception $ex) {
                // 
            }
        }
        return $loaded;
    }
}

