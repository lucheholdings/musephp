<?php
namespace Erato\Core\Metadata;

use Clio\Component\Pattern\Registry\LoadableRegistry,
	Clio\Component\Pattern\Registry\CacheRegistry,
	Clio\Component\Pattern\Registry\RegistryMap,
	Clio\Component\Pattern\Registry\Loader\MappedFactoryLoader
;
use Clio\Component\Util\Cache\Cache;
use Clio\Component\Util\Metadata\Schema\NamedMetadataFactory;

/**
 * MetadataRegistry 
 * 
 * @uses LoadableRegsitry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataRegistry extends LoadableRegsitry
{
	/**
	 * __construct 
	 * 
	 * @param NamedMetadataFactory $factory 
	 * @param Cache $cache 
	 * @access public
	 * @return void
	 */
	public function __construct(NamedMetadataFactory $factory, Cache $cache = null)
	{
		$registry = new RegistryMap();

		if($cache) {
			$registry = new CacheRegsitry($regsitry, $cache);
		}

		parent::__construct($registry);
		
		$this->addLoader(new MappedFactoryLoader($factory));
	}
}

