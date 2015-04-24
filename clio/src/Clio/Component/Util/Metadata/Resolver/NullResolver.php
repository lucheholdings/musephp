<?php
namespace Clio\Component\Util\Metadata\Resolver;

use Clio\Component\Util\Metadata\Resolver;

/**
 * NullResolver 
 * 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class NullResolver implements Resolver 
{
    /**
     * resolve 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function resolve($resource)
    {
        throw new \RuntimeException('NullResolver cannot resolve any resource');
    }
}
