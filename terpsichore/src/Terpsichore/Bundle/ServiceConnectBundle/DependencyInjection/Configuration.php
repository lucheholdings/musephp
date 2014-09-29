<?php

namespace Terpsichore\Bundle\ServiceConnectBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('terpsichore_service_connect');


		// 
		$rootNode
			->children()
				->scalarNode('client')->end()
				->arrayNode('services')
					->prototype('array')
						->children()
							->scalarNode('type')->end()
						->end()
					->end()
				->end()
			->end()
		;
		
		$hwiNode = $rootNode->children()->arrayNode('hwi');
		$hwiNode
			->addDefaultsIfNotSet()
		;

        $this->addHWIHttpClientConfiguration($hwiNode);
        //$this->addHWIConnectConfiguration($rootNode);
        $this->addHWIResourceOwnersConfiguration($hwiNode);

        return $treeBuilder;
    }
    /**
     * Array of supported resource owners, indentation is intentional to easily notice
     * which resource is of which type.
     *
     * @var array
     */
    private static $hwiResourceOwners = array(
        'oauth2' => array(
            'amazon',
            'bitly',
            'box',
            'dailymotion',
            'deviantart',
            'disqus',
            'eventbrite',
            'facebook',
            'foursquare',
            'github',
            'google',
            'hubic',
            'instagram',
            'linkedin',
            'mailru',
            'odnoklassniki',
            'qq',
            'salesforce',
            'sensio_connect',
            'sina_weibo',
            'soundcloud',
            'stack_exchange',
            'twitch',
            'vkontakte',
            'windows_live',
            'wordpress',
            'yandex',
            '37signals',
            'reddit'
        ),
        'oauth1' => array(
            'bitbucket',
            'dropbox',
            'flickr',
            'jira',
            'stereomood',
            'trello',
            'twitter',
            'yahoo',
        ),
    );

    /**
     * Return the type (OAuth1 or OAuth2) of given resource owner.
     *
     * @param string $resourceOwner
     *
     * @return string
     */
    public static function getHWIResourceOwnerType($resourceOwner)
    {
        if ('oauth1' === $resourceOwner || 'oauth2' === $resourceOwner) {
            return $resourceOwner;
        }

        if (in_array($resourceOwner, static::$hwiResourceOwners['oauth1'])) {
            return 'oauth1';
        }

        return 'oauth2';
    }

    /**
     * Checks that given resource owner is supported by this bundle.
     *
     * @param string $resourceOwner
     *
     * @return Boolean
     */
    public static function isHWIResourceOwnerSupported($resourceOwner)
    {
        if ('oauth1' === $resourceOwner || 'oauth2' === $resourceOwner) {
            return true;
        }

        return in_array($resourceOwner, static::$hwiResourceOwners['oauth1']) || in_array($resourceOwner, static::$hwiResourceOwners['oauth2']);
    }


    private function addHWIResourceOwnersConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->fixXmlConfig('resource_owner')
            ->children()
                ->arrayNode('resource_owners')
                    ->isRequired()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('base_url')->end()
                            ->scalarNode('access_token_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('authorization_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('request_token_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('revoke_token_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('infos_url')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('client_id')->end()
                            ->scalarNode('client_secret')->end()
                            ->scalarNode('realm')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('scope')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('user_response_class')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('service')
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->scalarNode('type')
                                ->validate()
                                    ->ifTrue(function($type) {
                                        return !Configuration::isHWIResourceOwnerSupported($type);
                                    })
                                    ->thenInvalid('Unknown resource owner type "%s".')
                                ->end()
                                ->validate()
                                    ->ifTrue(function($v) {
                                        return empty($v);
                                    })
                                    ->thenUnset()
                                ->end()
                            ->end()
                            ->arrayNode('paths')
                                ->useAttributeAsKey('name')
                                ->prototype('variable')
                                    ->validate()
                                        ->ifTrue(function($v) {
                                            if (null === $v) {
                                                return true;
                                            }

                                            if (is_array($v)) {
                                                return 0 === count($v);
                                            }

                                            if (is_string($v)) {
                                                return empty($v);
                                            }

                                            return !is_numeric($v);
                                        })
                                        ->thenInvalid('Path can be only string or array type.')
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('options')
                                ->useAttributeAsKey('name')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                // skip if this contains a service
                                if (isset($c['service'])) {
                                    return false;
                                }

                                // for each type at least these have to be set
                                foreach (array('type') as $child) {
                                    if (!isset($c[$child])) {
                                        return true;
                                    }
                                }

                                return false;
                            })
                            ->thenInvalid("You should set at least the 'type' of a resource owner.")
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                // skip if this contains a service
                                if (isset($c['service'])) {
                                    return false;
                                }

                                // Only validate the 'oauth2' and 'oauth1' type
                                if ('oauth2' !== $c['type'] && 'oauth1' !== $c['type']) {
                                    return false;
                                }

                                $children = array('authorization_url', 'access_token_url', 'request_token_url', 'infos_url');
                                foreach ($children as $child) {
                                    // This option exists only for OAuth1.0a
                                    if ('request_token_url' === $child && 'oauth2' === $c['type']) {
                                        continue;
                                    }

                                    if (!isset($c[$child])) {
                                        return true;
                                    }
                                }

                                return false;
                            })
                            ->thenInvalid("All parameters are mandatory for types 'oauth2' and 'oauth1'. Check if you're missing one of: 'access_token_url', 'authorization_url', 'infos_url' and 'request_token_url' for 'oauth1'.")
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                // skip if this contains a service
                                if (isset($c['service'])) {
                                    return false;
                                }

                                // Only validate the 'oauth2' and 'oauth1' type
                                if ('oauth2' !== $c['type'] && 'oauth1' !== $c['type']) {
                                    return false;
                                }

                                // one of this two options must be set
                                if (0 === count($c['paths'])) {
                                    return !isset($c['user_response_class']);
                                }

                                foreach (array('identifier', 'nickname', 'realname') as $child) {
                                    if (!isset($c['paths'][$child])) {
                                        return true;
                                    }
                                }

                                return false;
                            })
                            ->thenInvalid("At least the 'identifier', 'nickname' and 'realname' paths should be configured for 'oauth2' and 'oauth1' types.")
                        ->end()
                        ->validate()
                            ->ifTrue(function($c) {
                                if (isset($c['service'])) {
                                    // ignore paths & options if none were set
                                    return 0 !== count($c['paths']) || 0 !== count($c['options']) || 3 < count($c);
                                }

                                return false;
                            })
                            ->thenInvalid("If you're setting a 'service', no other arguments should be set.")
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addHWIHttpClientConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('http_client')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('timeout')->defaultValue(5)->cannotBeEmpty()->end()
                        ->booleanNode('verify_peer')->defaultTrue()->end()
                        ->scalarNode('max_redirects')->defaultValue(5)->cannotBeEmpty()->end()
                        ->booleanNode('ignore_errors')->defaultTrue()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    private function addHWIConnectConfiguration(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('connect')
                    ->children()
                        ->booleanNode('confirmation')->defaultTrue()->end()
                        ->scalarNode('account_connector')->cannotBeEmpty()->end()
                        ->scalarNode('registration_form_handler')->cannotBeEmpty()->end()
                        ->scalarNode('registration_form')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
