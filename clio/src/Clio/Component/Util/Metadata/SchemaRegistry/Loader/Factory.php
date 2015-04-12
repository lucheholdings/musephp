<?php
namespace Clio\Component\Util\Metadata\SchemaRegistry\Loader;

/**
 * Factory 
 *   Factory only provides static method, and never be instantiated. 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class Factory 
{
    /**
     * createLoader 
     * 
     * @param array $loaders 
     * @static
     * @access public
     * @return void
     */
    static public function createComplexLoader(array $loaders, $warmer = null)
    {
        if(1 == count($baseLoaders)) {
            $loader = array_shift($baseLoaders);
        } else {
            $loader = new MergeLoader($baseLoaders);
        }

        // if $warmer is specified to warmup metadata, then use WarmupLoader
        if($warmer) {
            $loader = new WarmupLoader($loader, $warmer);
        }

        return $loader;
    }
}

