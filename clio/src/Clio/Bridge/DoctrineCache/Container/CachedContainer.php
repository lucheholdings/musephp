<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Bridge\DoctrineCache\Container;

use Clio\Component\Util\Container\Container as ContainerInterface;
use Doctrine\Common\Cache\Cache as DoctrineCache;

/**
 * CachedContainer 
 * 
 * @uses ContainerInterface
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class CachedContainer implements ContainerInterface
{
	private $container;

	private $cache;

	public function __construct(ContainerInterface $container, DoctrineCache $cache = null)
	{
		$this->container = $container;
		$this->cache = $cache;
	}
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }
    
    public function getCache()
    {
        return $this->cache;
    }
    
    public function setCache(DoctrineCache $cache)
    {
        $this->cache = $cache;
        return $this;
    }

	public function isCached($key)
	{
		return $this->getCache()->contains($key);
	}

	public function getRaw()
	{
		return $this->getContainer()->getRaw();
	}
}

