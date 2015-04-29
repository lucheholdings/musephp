<?php
namespace Clio\Extra\Metadata\SchemaRegistry\Loader;

use Clio\Component\Metadata\SchemaRegistry\Loader\MergeLoader;
use Clio\Component\Metadata\SchemaRegistry\Loader\Warmer;
use Clio\Component\Metadata\SchemaRegistry\Loader\WarmupLoader;

use Clio\Component\Cache\CacheProvider;
use Clio\Extra\Registry\Loader\CacheLoader;

/**
 * Factory 
 * 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class Factory 
{
    /**
     * createComplexLoader
     * 
     * @param array $loaders 
     * @static
     * @access public
     * @return void
     */
    static public function createComplexLoader(array $baseLoaders, Warmer $warmer = null, CacheProvider $cacheProvider = null)
    {
        if(1 == count($baseLoaders)) {
            $loader = array_shift($baseLoaders);
        } else {
            $loader = new MergeLoader($baseLoaders);
        }

        // if $cache is specified, then 
        if($cacheProvider) {
            $loader = new CacheLoader($loader, $cacheProvider);
        }

        // if $warmer is specified to warmup metadata, then use WarmupLoader
        if($warmer) {
            $loader = new WarmupLoader($loader, $warmer);
        }

        return $loader;
    }
}
