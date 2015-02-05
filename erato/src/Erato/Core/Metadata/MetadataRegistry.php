<?php
namespace Erato\Core\Metadata;

use Clio\Component\Pattern\Registry\Loader\CachedLoader;
use Clio\Component\Util\Cache\CacheProvider;
use Clio\Component\Util\Metadata\Schema\Factory\MetadataFactory;
use Clio\Component\Util\Metadata\BasicSchemaRegistry;
use Clio\Component\Util\Metadata\Type\Registry as TypeRegistry;

/**
 * MetadataRegistry 
 * 
 * @uses LoadableRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class MetadataRegistry extends BasicSchemaRegsitry
{
	/**
	 * __construct 
	 * 
	 * @param MetadataFactory $factory 
	 * @param CacheProvider $cacheProvider 
	 * @access public
	 * @return void
	 */
	public function __construct(MetadataFactory $factory, TypeRegsitry $typeRegistry, CacheProvider $cacheProvider = null)
	{

		parent::__construct($factory, $typeRegsitry);

		if($cacheProvider) {
			$this->setEntryLoader(new CacheLoader($this->getEntryLoader(), $cacheProvider);
		}
	}
}

