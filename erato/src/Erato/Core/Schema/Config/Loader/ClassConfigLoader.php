<?php
namespace Erato\Core\Schema\Config\Loader;

use Clio\Component\Pattern\Loader\AbstractResourceLoader;
use Clio\Component\Pattern\Loader\Exception as LoaderExceptions;

/**
 * ClassConfigLoader 
 * 
 * @uses AbstractResourceLoader
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class ClassConfigLoader extends AbstractResourceLoader 
{
    /**
     * load 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function load($resource)
    {
        if(is_string($resource)) {
            try {
                $resource = new \ReflectionClass($resource);   
            } catch(\ReflectionException $ex) {
                throw new LoaderExceptions\ResourceNotFoundException();
            }
        }
        return parent::load($resource);
    }

    /**
     * import 
     * 
     * @param mixed $resource 
     * @access public
     * @return void
     */
    public function import($resource) 
    {
        if(!$resource instanceof \ReflectionClass) {
            throw new LoaderExceptions\InvalidResourceException('ClassConfigLoader only accept an instanceof ReflectionClass.');
        }

        return $resource;
    }
}

