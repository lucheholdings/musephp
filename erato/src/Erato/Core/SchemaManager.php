<?php
namespace Erato\Core;

use Clio\Component\Util\Metadata\Schema\SchemaMetadata;

/**
 * SchemaManager 
 * 
 * @uses SchemaManagerInterface
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaManager implements SchemaManagerInterface 
{
	/**
	 * __construct 
	 * 
	 * @param SchemaMetadata $metadata 
	 * @param Connection $connection 
	 * @access public
	 * @return void
	 */
	public function __construct(SchemaMetadata $metadata)
	{
		$this->metadata = $metadata;
	}

	/**
	 * {@inheritdoc}
	 */
	public function createModel()
	{
		return $this->getMetadadata()->getMappign('constructor')->construct(func_get_args());
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAccessor()
	{
		return $this->getMetadata()->getMapping('accessor')->getAccessor();
	}

	/**
	 * {@inheritdoc}
	 */
	public function schemify($data)
	{
		return $this->getMetadata()->getMapping('schemifier')->schemify($data);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMetadata()
	{
		return $this->metadata;
	}
}

