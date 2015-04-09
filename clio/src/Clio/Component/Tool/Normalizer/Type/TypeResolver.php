<?php
namespace Clio\Component\Tool\Normalizer\Type;

use Clio\Component\Tool\Normalizer\Type;
use Clio\Component\Util\Type\Resolver as TypeResolverInterface;
use Clio\Component\Util\Type as Types;

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
    static public function createDefault()
    {
        return new self(Types\Resolver\Factory::createWithRegistry(new Types\BasicRegistry()));
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

