<?php
namespace Erato\Core\Schema\Config\Parser;

use Erato\Core\Schema\Config;
use Clio\Component\Type;
use Clio\Component\Pattern\Parser\Exception as ParserException;

/**
 * DefaultClassConfigParser 
 * 
 * @uses AbstractParser
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DefaultClassConfigParser extends AbstractParser 
{
    /**
     * actualTypeResolver 
     * 
     * @var mixed
     * @access private
     */
    private $actualTypeResolver;

    /**
     * __construct 
     * 
     * @param TypeResolver $actualTypeResolver 
     * @access public
     * @return void
     */
    public function __construct(Type\Resolver $actualTypeResolver)
    {
        $this->actualTypeResolver = $actualTypeResolver;
    }

    /**
     * parse 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function parse($resource = null)
    {
        if(!$resource instanceof \ReflectionClass) {
            throw new ParserException\InvalidResourceException('DefaultClassConfigParser only parse an instanceof ReflectionClass.');
        }

        return parent::parseSchemaConfiguration($resource);
    }

    /**
     * doParseSchemaConfiguration 
     * 
     * @param Config\SchemaConfiguration $config 
     * @param mixed $resource 
     * @access protected
     * @return void
     */
    protected function doParseSchemaConfiguration(Config\SchemaConfiguration $config, $resource)
    {
        $config
            ->setName($resource->getName())
            ->setType($this->actualTypeResolver->resolve($resource->getName()))
        ;

        if($resource->getParentClass()) {
            $config->setParent($resource->getParentClass()->getName());
        }

        foreach($resource->getProperties() as $property) {
            $field = $config->addField($property->getName());
        }

        return $config;
    }
    
    /**
     * getActualTypeResolver 
     * 
     * @access public
     * @return void
     */
    public function getActualTypeResolver()
    {
        return $this->actualTypeResolver;
    }
    
    /**
     * setActualTypeResolver 
     * 
     * @param TypeResolver $actualTypeResolver 
     * @access public
     * @return void
     */
    public function setActualTypeResolver(Type\Resolver $actualTypeResolver)
    {
        $this->actualTypeResolver = $actualTypeResolver;
        return $this;
    }
}

