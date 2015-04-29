<?php
namespace Clio\Component\Normalizer\Type;

use Clio\Component\Normalizer\Type;
use Clio\Component\Type\Resolver as TypeResolverInterface;
use Clio\Component\Type as Types;

/**
 * TypeResolver 
 * 
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TypeResolver  
{
    static public function createWithRegistry(Types\Registry $typeRegistry)
    {
        $registeredResolver = new Types\Resolver\RegisteredResolver($typeRegistry);
        return new self(new Types\Resolver\TypeChainResolver(array(
            new Types\Resolver\ProxyTypeResolver(),
            new Types\Resolver\MixedTypeResolver(new Types\Guesser\SimpleGuesser($registeredResolver)),
            $registeredResolver
        )));
    }

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
     * @param TypeResolverInterface $actualTypeResolver 
     * @access public
     * @return void
     */
    public function __construct(TypeResolverInterface $actualTypeResolver)
    {
        $this->actualTypeResolver = $actualTypeResolver;
    }

    /**
     * resolve
     * 
     * @param mixed $type 
     * @access public
     * @return void
     */
    public function resolve($type, array $options = array())
    {
        if($type instanceof Type) {
            $type->setType($this->getActualTypeResolver()->resolve($type->getType(), $options));
        } else {
            $type = $this->getActualTypeResolver()->resolve($type, $options);
            $type = new NormalizerType($type);
        }
        return $type;
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
     * @param TypeResolverInterface $actualTypeResolver 
     * @access public
     * @return void
     */
    public function setActualTypeResolver(TypeResolverInterface $actualTypeResolver)
    {
        $this->actualTypeResolver = $actualTypeResolver;
        return $this;
    }
}

