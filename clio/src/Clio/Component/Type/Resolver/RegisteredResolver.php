<?php
namespace Clio\Component\Type\Resolver;

use Clio\Component\Type\Resolver;
use Clio\Component\Type\Registry;

/**
 * RegisteredResolver 
 *    Resolve type registered on TypeRegistry. 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class RegisteredResolver implements Resolver 
{
    /**
     * typeRegistry 
     * 
     * @var mixed
     * @access private
     */
    private $typeRegistry;

    /**
     * __construct 
     * 
     * @param Registry $typeRegistry 
     * @access public
     * @return void
     */
    public function __construct(Registry $typeRegistry)
    {
        $this->typeRegistry = $typeRegistry;
    }

    /**
     * resolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function resolve($type, array $options = array())
    {
        return $this->typeRegistry->get($type);
    }

    /**
     * canResolve 
     * 
     * @param mixed $type 
     * @param array $options 
     * @access public
     * @return void
     */
    public function canResolve($type, array $options = array())
    {
        return $this->typeRegistry->has($type);
    }
     
     /**
      * getTypeRegistry 
      * 
      * @access public
      * @return void
      */
     public function getTypeRegistry()
     {
         return $this->typeRegistry;
     }
     
     /**
      * setTypeRegistry 
      * 
      * @param mixed $typeRegistry 
      * @access public
      * @return void
      */
     public function setTypeRegistry(Registry $typeRegistry)
     {
         $this->typeRegistry = $typeRegistry;
         return $this;
     }
}

