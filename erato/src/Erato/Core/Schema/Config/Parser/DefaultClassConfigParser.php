<?php
namespace Erato\Core\Schema\Config\Parser;

use Erato\Core\Schema\Config\Parser;
use Erato\Core\Schema\Config\SchemaConfiguration,
    Erato\Core\Schema\Config\FieldConfiguration;
use Clio\Component\Util\Type;

/**
 * DefaultClassConfigParser 
 * 
 * @uses Parser
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class DefaultClassConfigParser implements Parser 
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
            throw new InvalidResourceException('DefaultClassConfigParser only parse an instanceof ReflectionClass.');
        }

        $config = new SchemaConfiguration();
        $config
            ->setName($resource->getName())
            ->setType($this->actualTypeResolver->resolve($resource->getName()))
        ;

        if($resource->getParentClass()) {
            $config->setParent($resource->getParentClass()->getName());
        }

        foreach($resource->getProperties() as $property) {
            $field = new FieldConfiguration();
            $field
                ->setName($property->getName())
                ->setType(new Type\MixedType())
            ;

            $config->addField($field);
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

