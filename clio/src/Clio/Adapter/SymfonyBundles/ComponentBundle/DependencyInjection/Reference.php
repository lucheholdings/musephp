<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

interface Reference 
{
    function _setContainer(ContainerInterface $container = null);
    
    function _setServiceId($serviceId);
}

