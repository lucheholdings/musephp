<?php
namespace Calliope\Extra\Filter\Listener;

use Calliope\Bridge\SymfonyComponents\Filter\Event\FilterEvent;
use Clio\Component\Util\Cache\CacheProvider;

/**
 * CacheListener 
 * 
 * @uses FilterListener
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CacheListener 
{
	private $cacheProvider;

	public function __construct(CacheProvider $cacheProvider)
	{
		$this->cacheProvier = $cacheProvider;
	}

	public function onPreFetch(FilterEvent $event)
	{
	}

	public function onPostFetch(FilterEvent $event)
	{
	}
    
    public function getCacheProvider()
    {
        return $this->cacheProvider;
    }
    
    public function setCacheProvider(CacheProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
        return $this;
    }
}

