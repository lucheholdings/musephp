<?php
namespace Clio\Component\Util\Metadata\Resolver;

use Clio\Component\Util\Metadata\Exception as MetadataException;
use Clio\Component\Util\Metadata\Resolver;
use Clio\Component\Util\Metadata\Registry as SchemaRegistry;

/**
 * RegisteredResolver 
 * 
 * @uses Resolver
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class RegisteredResolver implements Resolver 
{
    /**
     * registry 
     * 
     * @var mixed
     * @access private
     */
    private $registry;

    /**
     * __construct 
     * 
     * @param SchemaRegistry $registry 
     * @access public
     * @return void
     */
    public function __construct(SchemaRegistry $registry = null)
    {
        $this->registry = $registry;
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
        if(!$this->registry) {
            throw new MetadataException\CannotResolveException('Registry is not initialized yet');
        }
        try {
            return $this->registry->get($resource);
        } catch(LoaderException $ex) {
            throw new CannotResolveException('Faield to resolve', 0, $ex);
        }
    }
    
    /**
     * getRegistry 
     * 
     * @access public
     * @return void
     */
    public function getRegistry()
    {
        return $this->registry;
    }
    
    /**
     * setRegistry 
     * 
     * @param SchemaRegistry $registry 
     * @access public
     * @return void
     */
    public function setRegistry(SchemaRegistry $registry)
    {
        $this->registry = $registry;
        return $this;
    }
}

