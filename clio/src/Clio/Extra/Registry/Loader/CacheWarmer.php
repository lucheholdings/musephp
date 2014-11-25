<?php
namespace Clio\Extra\Registry\Loader;

/**
 * CacheWarmer 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
interface CacheWarmer
{
	/**
	 * warmup 
	 * 
	 * @param mixed $cached data which need to warmup 
	 * @access public
	 * @return mixed warmed up data 
	 */
	function warmup($cached);
}

