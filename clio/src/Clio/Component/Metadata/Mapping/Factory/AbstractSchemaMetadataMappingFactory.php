<?php
namespace Clio\Component\Metadata\Mapping\Factory;

use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\SchemaMetadata;

/**
 * AbstractFactory 
 * 
 * @uses AbstractFactory
 * @uses Factory
 * @abstract
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
abstract class AbstractSchemaMetadataMappingFactory extends AbstractFactory 
{
	public function isSupportedMetadata(Metadata $metadata)
	{
		return ($metadata instanceof SchemaMetadata);
	}
}
