<?php
namespace Erato\Core\Schema\Mapping\Factory;

use Clio\Component\Metadata\Mapping\Factory\AbstractFactory;
use Erato\Core\Schema\Mapping\IdentifierMapping;
use Clio\Component\Metadata\Metadata;
use Clio\Component\Metadata\Exception as MetadataException;
use Clio\Component\Metadata\Schema;

/**
 * IdentifierMappingFactory 
 * 
 * @uses AbstractMappingFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class IdentifierMappingFactory extends AbstractFactory 
{
	/**
	 * {@inheritdoc}
	 */
	public function doCreateMapping(Metadata $metadata, array $options)
	{
        if(!$metadata instanceof Schema) {
            throw new \InvalidArgumentException(sprintf('IdentifierMapping is only for SchemaMetadata, but "%s" is given.', get_class($metadata)));
        } else if(!isset($options['fields'])) {
            throw new MetadataException\UnsupportedException('Identifier field is not specified.');
        }
		$mapping = new IdentifierMapping($metadata, $options);

        return $mapping;
	}
}

