<?php
namespace Clio\Component\Util\Metadata;

use Clio\Component\Pattern\Registry\ProxyRegistry;

/**
 * ProxySchemaMetadataRegistry 
 * 
 * @uses ProxyRegistry
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ProxySchemaMetadataRegistry extends ProxyRegistry implements SchemaMetadataRegistry 
{
	/**
	 * {@inheritdoc}
	 */
	public function getSchemaMetadata($schemaName)
	{
		return $this->get($schemaName);
	}
}

