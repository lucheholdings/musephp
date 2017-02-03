<?php
namespace Clio\Adapter\SymfonyBundles\OAuth2ClientBundle\DependencyInjection\Security\Factory;

use Symfony\Component\DependencyInjection\ContainerBuilder,
	Symfony\Component\DependencyInjection\Reference,
	Symfony\Component\DependencyInjection\DefinitionDecorator
;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;
/**
 * 
 * 
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license MIT
 */
class OAuth2PasswordGrantFactory extends FormLoginFactory
{
	/**
	 * __construct 
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->addOption('token_provider');
	}

	/**
	 * getKey 
	 * 
	 * @access public
	 * @return void
	 */
	public function getKey()
	{
		return 'oauth2_password';
	}

    /**
     * createAuthProvider 
     * 
     * @param ContainerBuilder $container 
     * @param mixed $id 
     * @param mixed $config 
     * @param mixed $userProviderId 
     * @access protected
     * @return void
     */
    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $provider = 'security.authentication.provider.oauth2_client.'.$id;
        $container
            ->setDefinition($provider, new DefinitionDecorator('security.authentication.provider.oauth2_password_grant'))
			->replaceArgument(0, new Reference($config['token_provider']))
			->replaceArgument(1, new Reference($userProviderId))
            //->replaceArgument(0, new Reference($userProviderId))
            //->replaceArgument(2, $id)
        ;

        return $provider;
    }
}

