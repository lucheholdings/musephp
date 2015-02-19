<?php

namespace Clio\Adapter\SymfonyBundles\ComponentBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Console\Application;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Clio\Adapter\SymfonyBundles\ComponentBundle\DependencyInjection\Compiler;

class ClioComponentBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);

		$container->addCompilerPass(new Compiler\ReferenceCompilerPass());
		$container->addCompilerPass(new Compiler\TaskCompilerPass());
	}

    public function registerCommands(Application $application)
	{
		parent::registerCommands($application);

		$this->registerHelpers($application);
	}

	protected function registerHelpers(Application $application)
	{
        if (!is_dir($dir = $this->getPath().'/Console/Helper')) {
            return;
        }

        $finder = new Finder();
        $finder->files()->name('*Helper.php')->in($dir);

        $prefix = $this->getNamespace().'\\Console\\Helper';
        foreach ($finder as $file) {
            $ns = $prefix;
            if ($relativePath = $file->getRelativePath()) {
                $ns .= '\\'.strtr($relativePath, '/', '\\');
            }
            $class = $ns.'\\'.$file->getBasename('.php');
            //if ($this->container) {
            //    $alias = 'console.helper.'.strtolower(str_replace('\\', '_', $class));
            //    if ($this->container->has($alias)) {
            //        continue;
            //    }
            //}
            $r = new \ReflectionClass($class);
            if ($r->implementsInterface('Symfony\\Component\\Console\\Helper\\HelperInterface') && !$r->isAbstract() && (!$r->getConstructor() || !$r->getConstructor()->getNumberOfRequiredParameters())) {
                $application->getHelperSet()->set($r->newInstance());
            }
        }
	}
}
