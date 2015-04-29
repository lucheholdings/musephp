<?php
namespace Clio\Component\Metadata\Resolver;

use Clio\Component\Metadata\Resolver;
use Clio\Component\Metadata\Schema\LazySchemaMetadata;

use Clio\Component\Metadata\Exception as MetadataException;

/**
 * LazyResolver 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class LazyResolver implements Resolver
{
    /**
     * actualResolver 
     * 
     * @var mixed
     * @access private
     */
    private $actualResolver;

    /**
     * __construct 
     * 
     * @param Resolver $actualResolver 
     * @access public
     * @return void
     */
    public function __construct(Resolver $actualResolver)
    {
        $this->actualResolver = $actualResolver;
    }

    /**
     * resolve 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function resolve($resource)
    {
        try {
            $resolved = $this->getActualResolver()->resolve($resource);
        } catch(MetadataException\CannotResolveException $ex) {
            $resolved = new LazySchemaMetadata($this->actualResolver, $resource);
        }

        return $resolved;
    }
    
    /**
     * getActualResolver 
     * 
     * @access public
     * @return void
     */
    public function getActualResolver()
    {
        return $this->actualResolver;
    }
    
    /**
     * setActualResolver 
     * 
     * @param Resolver $actualResolver 
     * @access public
     * @return void
     */
    public function setActualResolver(Resolver $actualResolver)
    {
        $this->actualResolver = $actualResolver;
        return $this;
    }
}

