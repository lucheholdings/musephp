<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle;

use Clio\Adapter\SymfonyBundles\ComponentBundle\Proxy\ServiceProxy;
use Erato\Core\Schema\Registry;

class ProxySchemaRegistry extends ServiceProxy implements Registry 
{
    public function has($key)
    {
        return $this->__getWrapped()->has($key);
    }

    public function get($key)
    {
        return $this->__getWrapped()->get($key);
    }
}
 
