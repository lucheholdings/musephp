<?php
namespace Clio\Component\Util\Metadata\Type;

use Clio\Component\Pattern\Registry\EntryLoader;
use Clio\Component\Util\Metadata\SchemaRegistry;

use Clio\Component\Util\Type\BaseRegistry as Registry;

/**
 * Registry 
 * 
 * @uses RegistryMap
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class BaseRegistry extends Registry 
{
	private $schemaRegistry;

	public function __construct(EntryLoader $loader, SchemaRegistry $schemaRegistry = null)
	{
		parent::__construct($loader);

		$this->schemaRegistry = $schemaRegistry;
	}

	protected function load($key)
	{
		$loaded = parent::load($key);

		// Set SchemaRegistry to load relative Schema from type
		if($loaded instanceof SchemaReferenceType) {
			$loaded->setSchemaRegistry($this->getSchemaRegistry());
		}

		return $loaded;
	}
    
    public function getSchemaRegistry()
    {
		if(!$this->schemaRegistry) {
			throw new \RuntimeException(sprintf('SchemaRegistry is not initialized yet.'));
		}
        return $this->schemaRegistry;
    }
    
    public function setSchemaRegistry(SchemaRegistry $schemaRegistry)
    {
        $this->schemaRegistry = $schemaRegistry;
        return $this;
    }
}

