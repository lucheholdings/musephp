<?php
namespace Erato\Core\Schema\Mapping\Factory;

use Clio\Component\Metadata\Mapping\Factory\AbstractSchemaMetadataMappingFactory;
use Erato\Core\Schema\Mapping\SchemaReplacerMapping;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\SchemaMetadata;

/**
 * SchemaReplacerMappingFactory 
 * 
 * @uses AbstractMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaReplacerMappingFactory extends AbstractSchemaMetadataMappingFactory
{
	/**
	 * {@inheritdoc}
	 */
	public function doCreateMapping(Metadata $metadata, array $options)
	{

		if(!isset($options['ignore_fields']))
			$options['ignore_fields'] = $this->getOption('ignore_fields', array());
		else
			$options['ignore_fields'] = array_merge($this->getOption('ignore_fields', array()), $options['ignore_fields']);

		return new SchemaReplacerMapping($metadata, $options);
	}

	/**
	 * isSupportedMetadata 
	 * 
	 * @param Metadata $metadata 
	 * @access public
	 * @return void
	 */
	public function isSupportedMetadata(Metadata $metadata)
	{
		return ($metadata instanceof SchemaMetadata);
	}
}

