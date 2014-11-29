<?php
namespace Erato\Core\Manager;

use Clio\Component\Util\Metadata\Schema\SchemaMetadata;
use Erato\Core\SchemaManager as SchemaManagerInterface;

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
	public function newInstance()
	{
		if(!$this->getMetadata()->hasMapping('consturctor')) {
			throw new \RuntimeException(sprintf('Schema "%s" does not support Mapping constructor.', $this->getMetadata()));
		}
		return $this->getMetadadata()->getMappign('constructor')->construct(func_get_args());
	}

	/**
	 * {@inheritdoc}
	 */
	public function getAccessor()
	{
		if(!$this->getMetadata()->hasMapping('accessor')) {
			throw new \RuntimeException(sprintf('Schema "%s" does not support Mapping accessor.', $this->getMetadata()));
		}
		return $this->getMetadata()->getMapping('accessor')->getAccessor();
	}

	/**
	 * {@inheritdoc}
	 */
	public function schemify($data)
	{
		if(!$this->getMetadata()->hasMapping('schemifier')) {
			throw new \RuntimeException(sprintf('Schema "%s" does not support Mapping schemifier.', $this->getMetadata()));
		}
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

