<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    public function getRootDir()
    {
        return __DIR__.'/Resources';
    }

    public function registerBundles()
    {
        return array(
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\AsseticBundle\Tests\TestBundle\TestBundle(),
			new \Clio\Adapter\SymfonyBundles\ComponentBundle\ClioComponentBundle(),
			new \Erato\Adapter\SymfonyBundles\FrameworkBundle\EratoFrameworkBundle(),
        );
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/Resources/config/config.yml');
    }
}
