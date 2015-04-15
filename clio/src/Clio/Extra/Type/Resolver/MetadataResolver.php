<?php
namespace Clio\Extra\Type\Resolver;

/**
 * MetadataResolver 
 *   Resolve Type from given Metadata 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class MetadataResolver implements TypeResolver 
{
    /**
     * canResolve 
     * 
     * @param mixed $resource 
     * @param array $options 
     * @access public
     * @return void
     */
    public function canResolve($resource, array $options = array())
    {
        return ($resource instanceof Metadata);
    }

    /**
     * resolve 
     * 
     * @param mixed $resource 
     * @param array $options 
     * @access public
     * @return void
     */
    public function resolve($resource, array $options = array())
    {
        if($resource instanceof Schema) {
            return new ExtraTypes\SchemaMetadataType($resource);
        } else if($resource instanceof Field) {
            return new ExtraTypes\FieldMetadataType($resource);
        }

        throw new UnsupportedException('MetadataResolver cannot resolver the resource.');
    }
}

