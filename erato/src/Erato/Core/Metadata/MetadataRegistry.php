<?php
namespace Erato\Core\Metadata;

use Clio\Component\Pattern\Registry\LoadableRegistry,
	Clio\Component\Pattern\Registry\Loader\CachedLoader,
	Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader
;
use Clio\Component\Util\Cache\CacheProvider;
use Clio\Component\Util\Metadata\Schema\Factory\MetadataFactory;

/**
 * MetadataRegistry 
 * 
 * @uses LoadableRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataRegistry extends LoadableRegistry
{
	/**
	 * __construct 
	 * 
	 * @param MetadataFactory $factory 
	 * @param CacheProvider $cacheProvider 
	 * @access public
	 * @return void
	 */
	public function __construct(MetadataFactory $factory, CacheProvider $cacheProvider = null)
	{
		$loader = new MappedFactoryLoader($factory);
		if($cacheProvider) {
			$loader = new CachedLoader($loader, $cacheProvider);
		}

		parent::__construct($loader);
	}
}

