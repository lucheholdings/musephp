<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection\ClioOAuth2ClientExtension;
use Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection\Security\Factory\OAuth2PasswordGrantFactory,
	Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection\Security\Factory\OAuth2AuthorizationCodeGrantFactory
;
use Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection\Security\UserProvider\OAuth2UserProviderFactory;

/**
 * ClioOAuth2ClientBundle 
 * 
 * @uses Bundle
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class ClioOAuth2ClientBundle extends Bundle
{

    /**
     * __construct 
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->extension = new ClioOAuth2ClientExtension();
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
			$extension->addSecurityListenerFactory(new OAuth2PasswordGrantFactory());
			$extension->addSecurityListenerFactory(new OAuth2AuthorizationCodeGrantFactory());

			$extension->addUserProviderFactory(new OAuth2UserProviderFactory());
        }
	}
}
