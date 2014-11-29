<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Cache\Factory;

use Clio\Bridge\DoctrineCommon\Cache\Factory\DoctrineCacheProviderFactory as BaseFactory;
use Symfony\Component\DependencyInjection\ContainerInterface,
	Symfony\Component\DependencyInjection\ContainerAwareInterface
;

class DoctrineCacheProviderFactory extends BaseFactory implements ContainerAwareInterface
{
	private $container;

	public function __construct(ContainerInterface $container = null)
	{
		parent::__construct();

		$this->container = $container;
	}

	public function shiftArg(array &$args, $aliasKey = null, $default = null) 
	{
		$arg = parent::shiftArg($args, $aliasKey, $default);

		switch($aliasKey) {
		case 'couchbase':
		case 'memcache':
		case 'memcached':
		case 'redis':
			// 
			if(is_string($arg)) {
				$arg = $this->getContainer()->get($arg);
			}
			break;
		default:
			break;
		}

		return $arg;
	}
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }
}
