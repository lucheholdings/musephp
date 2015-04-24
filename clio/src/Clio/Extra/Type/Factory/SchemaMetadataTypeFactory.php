<?php
namespace Clio\Extra\Type\Factory;

use Clio\Component\Util\Type\Factory\AbstractTypeFactory;
use Clio\Extra\Type as ExtraTypes;
use Clio\Component\Util\Metadata\Resolver as SchemaResolver;

/**
 * SchemaMetadataTypeFactory 
 * 
 * @uses AbstractTypeFactory
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaMetadataTypeFactory extends AbstractTypeFactory 
{
    /**
     * schemaResolver 
     * 
     * @var mixed
     * @access private
     */
    private $schemaResolver;

    /**
     * __construct 
     * 
     * @param SchemaResolver $schemaResolver 
     * @access public
     * @return void
     */
    public function __construct(SchemaResolver $schemaResolver)
    {
        parent::__construct();
        $this->schemaResolver = $schemaResolver;
    }

    /**
     * createType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
    public function createType($name, array $options = array())
    {
        try {
            $schema = $this->schemaResolver->resolve($name);
        } catch(\Exception $ex) {
            throw new \InvalidArgumentException(sprintf('Schema "%s" cannot resolved.', $name));
        }
        return new ExtraTypes\SchemaMetadataType($schema);
    }

    /**
     * isSupportedType 
     * 
     * @param mixed $name 
     * @access public
     * @return void
     */
	public function isSupportedType($name)
    {
        try {
            return (bool)$this->schemaResolver->resolve($name);
        } catch(\Exception $ex) {
            return false;
        }
    }
    
    /**
     * getSchemaResolver 
     * 
     * @access public
     * @return void
     */
    public function getSchemaResolver()
    {
        return $this->schemaResolver;
    }
    
    /**
     * setSchemaResolver 
     * 
     * @param mixed $schemaResolver 
     * @access public
     * @return void
     */
    public function setSchemaResolver(SchemaResolver $schemaResolver)
    {
        $this->schemaResolver = $schemaResolver;
        return $this;
    }
}

