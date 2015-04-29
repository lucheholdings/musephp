<?php
namespace Clio\Component\Metadata;

/**
 * Resolver 
 *   
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Resolver
{
    /**
     * resolve 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    function resolve($resource);
}

