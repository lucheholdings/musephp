<?php
namespace Erato\Core\Accessor;

use Clio\Component\Pattern\Registry\ReferenceRegistry;
use Clio\Component\Metadata\SchemaRegistry;

use Clio\Component\Accessor\Schema\Registry;
/**
 * SchemaAccessorRegistry 
 * 
 * @uses MetadataReferenceRegistry
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaAccessorRegistry extends ReferenceRegistry implements Registry 
{
	private $metadataRegistry;

	public function __construct(SchemaRegistry $metadataRegistry)
	{
		$this->metadataRegistry = $metadataRegistry;
	}

	public function get($name)
	{
		$metadata = $this->getMetadataRegistry()->get($name);

		return $metadata->getMapping('accessor')->getAccessor();
	}

	public function has($name)
	{
		if(!$this->getMetadataRegistry()->has($name))
			return false;

		$metadata = $this->getMetadataRegistry()->get($name);
		return $metadata->hasMapping('accessor');
	}
    
    public function getMetadataRegistry()
    {
        return $this->metadataRegistry;
    }
    
    public function setMetadataRegistry($metadataRegistry)
    {
        $this->metadataRegistry = $metadataRegistry;
        return $this;
    }
}

