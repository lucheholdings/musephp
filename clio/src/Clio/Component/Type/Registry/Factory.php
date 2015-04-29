<?php
namespace Clio\Component\Type\Registry;

use Clio\Component\Type\Loader;
use Clio\Component\Pattern\Registry as Registries;

abstract class Factory 
{
    static public function createDefault()
    {
        return new ValidateRegistry(new Registries\LoadableRegistry(
                Loader\Factory::createDefault()
            ));
    }

    static public function createWithFactories(array $factories)
    {
        return new ValidateRegistry(new Registries\LoadableRegistry(
                Loader\Factory::createWithFactories($factories)
            ));
    }
}

