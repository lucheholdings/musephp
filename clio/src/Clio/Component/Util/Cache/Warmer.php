<?php
namespace Clio\Component\Util\Cache;

/**
 * Warmer 
 *   Interface of CacheWarmer.
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface Warmer
{
    /**
     * warmup 
     *   Warmup cached data 
     * @access public
     * @return void
     */
    function warmup($cached);
}

