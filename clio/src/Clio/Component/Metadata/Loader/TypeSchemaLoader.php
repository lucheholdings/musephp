<?php
namespace Clio\Component\Metadata\Loader;

use Clio\Component\Metadata\Loader;
use Clio\Component\Metadata\Schema;
use Clio\Component\Type;
use Clio\Component\Pattern\Loader\Exception as LoaderException;

/**
 * TypeSchemaLoader 
 *   
 * @uses Loader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeSchemaLoader implements Loader 
{
    private $typeResolver;

    public function __construct(Type\Resolver $typeResolver = null)
    {
        if(!$typeResolver) {
            $typeResolver = Type\Resolver\Factory::createWithFactories(array(new Type\Factory\PrimitiveTypeFactory()));
        }
        $this->typeResolver = $typeResolver;
    }

    /**
     * load 
     * 
     * @param mixed $schemaName 
     * @access public
     * @return void
     */
    public function load($schemaName)
    {
        try { 
            $type = $this->typeResolver->resolve($schemaName);
        } catch(Type\Exception\CannotResolveException $ex) {
            throw new LoaderException\InvalidResourceException(sprintf('Resource "%s" is not invalid.', (string)$schemaName), 0, $ex);
        }

        return new Schema\SchemaMetadata($type, $schemaName);
    }
}

