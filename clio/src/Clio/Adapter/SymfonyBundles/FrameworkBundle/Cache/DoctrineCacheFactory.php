<?php
/**
 * ${ FILENAME }
 * 
 * @copyright ${ COPYRIGHT }
 * @license ${ LICENSE }
 * 
 */
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Cache;

use Clio\Adapter\DoctrineExtensions\Cache\CacheFactory as BaseCacheFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * CacheFactory 
 * 
 * @uses BaseCacheFactory
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class DoctrineCacheFactory extends BaseCacheFactory implements CacheFactoryInterface 
{
	private $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;

		parent::__construct();
	}
	
	protected function doCreate(array $args = array())
	{
		$storage = reset($args);
		if(is_string($storage)) {
			switch($storage) {
			case 'array':
			case 'file':
			case 'php':
			case 'file_system':
				break;
			default:
				// replace the first args
				if(!$this->getContainer()->has($storage)) {
					//
					throw new \InvalidArgumentException(sprintf('Storage "%s" cannot be solved.', $storage));
				}
				$storage = $this->getContainer()->get($storage);
				array_unshift(array_shift($args), $storage);
				break;
			}
		}

		return parent::doCreate($args);
	}
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }
}
