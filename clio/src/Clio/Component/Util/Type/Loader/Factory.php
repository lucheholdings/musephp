<?php
namespace Clio\Component\Util\Type\Loader;

use Clio\Component\Pattern\Loader;
use Clio\Component\Util\Type\Factory as Factories;

/**
 * Factory 
 *   Factory methods to create loaders 
 * @abstract
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
abstract class Factory
{
    /**
     * createDefault 
     *    
     * @static
     * @access public
     * @return void
     */
    static public function createDefault()
    {
        return new Loader\FactoryLoader(
            new Factories\TypeFactoryCollection(array(
                new Factories\ClassTypeFactory(),
                new Factories\PrimitiveTypeFactory(),
            )));
    }

    /**
     * createWithFactories 
     *   Create with Type Factories 
     * @param array $factories 
     * @static
     * @access public
     * @return void
     */
    static public function createWithFactories(array $factories = array())
    {
        if(empty($factories)) {
            return self::createDefault();
        }

        return new Loader\FactoryLoader(
                new Factories\TypeFactoryCollection($factories)
            );
    }
}

