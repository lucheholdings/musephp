<?php
namespace Clio\Component\Type\Guesser;

use Clio\Component\Type\Guesser;
use Clio\Component\Type\Resolver;

/**
 * SimpleGuesser 
 *   Get type as an object or a primitive type from value
 * @uses Guesser
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SimpleGuesser implements Guesser 
{
    /**
     * create 
     * 
     * @param Resolver $resolver 
     * @static
     * @access public
     * @return void
     */
    static public function create(Resolver $resolver)
    {
        return new self($resolver);
    }

    /**
     * resolver 
     * 
     * @var mixed
     * @access private
     */
    private $resolver;

    /**
     * __construct 
     * 
     * @param Resolver $resolver 
     * @access public
     * @return void
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * guess 
     * 
     * @param mixed $value 
     * @access public
     * @return void
     */
    public function guess($value)
    {
        $guessed = is_object($value) ? get_class($value) : strtolower(gettype($value));

        return $this->getResolver()->resolve($guessed);
    }
    
    /**
     * getResolver 
     * 
     * @access public
     * @return void
     */
    public function getResolver()
    {
        return $this->resolver;
    }
    
    /**
     * setResolver 
     * 
     * @param Resolver $resolver 
     * @access public
     * @return void
     */
    public function setResolver(Resolver $resolver)
    {
        $this->resolver = $resolver;
        return $this;
    }
}

