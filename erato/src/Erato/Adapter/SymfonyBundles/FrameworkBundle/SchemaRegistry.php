<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle;

use Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection\ServiceReference;

use Erato\Core\SchemaRegistry as RegistryInterface;

/**
 * SchemaRegistry 
 * 
 * @uses ServiceReference
 * @uses RegistryInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaRegistry extends ServiceReference implements RegistryInterface 
{
	/**
	 * {@inheritdoc}
	 */
	public function getSchemaMetadata($schemaName)
	{
		return $this->get($schemaName);
	}

    /**
     * get 
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
	public function get($key)
	{
		if(!$this->getRegistry()->has($key)) {
			$entry = parent::get($key);

			if($entry) {
				if($entry->hasParent()) {
					$entry->setParent($this->get($entry->getParentName()));
				}
			}
		}

		return $this->getRegistry()->get($key);
	}
}
 
