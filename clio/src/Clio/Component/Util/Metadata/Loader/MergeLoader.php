<?php
namespace Clio\Component\Util\Metadata\Loader;

/**
 * MergeLoader 
 * 
 * @uses SequentialLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MergeLoader extends SequentialLoader 
{
    /**
     * load 
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function load($type)
    {
        $loadeds = parent::load($type);

        return $this->merge($loadeds);
    }

    /**
     * merge 
     * 
     * @param array $metadatas 
     * @access public
     * @return void
     */
    public function merge(array $metadatas)
    {
        if(1 >= count($metadatas)) {
            return reset($metadatas);
        }

        $base = array_shift($metadatas);

        while(0 < count($metadatas)) {
            $next = array_shift($metadatas);

            $base = $base->merge($next);
        }

        return $base;
    }
}

