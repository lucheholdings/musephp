<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DependencyInjection\Security\Factory\OAuth2ProviderFactory;

/**
 * TerpsichoreOAuth2ServerBundle 
 * 
 * @uses Bundle
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class TerpsichoreOAuth2ServerBundle extends Bundle
{
    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->extension = new DependencyInjection\TerpsichoreOAuth2ServerExtension();
    }

    /**
     * build 
     * 
     * @param ContainerBuilder $container 
     * @access public
     * @return void
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        if (version_compare(Kernel::VERSION, '2.1', '>=')) {
            $extension = $container->getExtension('security');
            $extension->addSecurityListenerFactory(new OAuth2ProviderFactory());
        }

		// Add Storage and Grant Types
        $container->addCompilerPass(new DependencyInjection\Compiler\ResponseTypeCompilerPass());
        $container->addCompilerPass(new DependencyInjection\Compiler\StorageStrategyFactoryCompilerPass());
        $container->addCompilerPass(new DependencyInjection\Compiler\StorageCompilerPass());
        $container->addCompilerPass(new DependencyInjection\Compiler\GrantTypeCompilerPass());
        $container->addCompilerPass(new DependencyInjection\Compiler\TokenResolverFactoryCompilerPass());
    }
}
