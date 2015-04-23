<?php
namespace Clio\Component\Util\Metadata\Schema;

use Clio\Component\Util\Type as Types;

/**
 * ClassPropertyLoader 
 * 
 * @uses FieldLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassPropertyLoader implements FieldLoader
{
    /**
     * loadFields 
     * 
     * @param Schema $schema 
     * @access public
     * @return void
     */
    public function loadFields(Schema $schema)
    {
        if(!$schema->isType(Types\PrimitiveTypes::TYPE_CLASS)) {
            throw new \InvalidArgumentException(sprintf('Schema "%s" is not a class schema.', $schema->getName()));
        }

        // Get reflector
        $reflector = $schema->getType()->getReflector();

        foreach($reflector->getProperties() as $property) {
            // create from property 
            $fields[$property->getName()] = new Field($property->getName(), new Types\MixedType(), $schema);
        }
        
        return $fields;
    }
}

