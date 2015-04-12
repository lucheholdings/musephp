<?php
namespace Clio\Component\Util\Metadata\Field;

use Clio\Component\Util\Metadata\Field;
use Clio\Component\Util\Metadata\Schema;

/**
 * PropertyFieldMetadata 
 * 
 * @uses AbstractFieldMetadata
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class PropertyFieldMetadata extends FieldMetadata 
{
    /**
     * reflector 
     * 
     * @var mixed
     * @access private
     */
    private $reflector;

    /**
     * __construct 
     * 
     * @param Schema $schema 
     * @param \ReflectionProperty $reflector 
     * @param Schema $typeSchema 
     * @param array $mappings 
     * @param array $options 
     * @param Field $parent 
     * @access public
     * @return void
     */
    public function __construct(Schema $schema, \ReflectionProperty $reflector, Schema $typeSchema = null, array $mappings = array(), array $options = array(), Field $parent = null)
    {
        $this->reflector = $reflector;

        parent::__construct($schema, $reflector->getName(), $typeSchema, $mappings, $options, $parent); 
    }
    
    /**
     * getReflector 
     * 
     * @access public
     * @return void
     */
    public function getReflector()
    {
        return $this->reflector;
    }

    public function serialize(array $extra = array())
    {
        $extra['property_container'] = $this->reflector->getDeclaringClass()->getName();
        $extra['property_name']      = $this->reflector->getName();

        return parent::serialize($extra);
    }

    public function unserialize($serialized)
    {
        $extra = parent::unserialize($serialized);
        $propertyContainer = $extra['property_container'];
        $propertyName = $extra['property_name'];

        $this->reflector = new \ReflectionProperty($propertyContainer, $propertyName);

        return $extra;
    }
}

