<?php

namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration 
 * 
 * @uses ConfigurationInterface
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('terpsichore_oauth2_server');

		$rootNode
			->children()
				->scalarNode('scope_delemiter')->defaultValue(' ')->end()
				->scalarNode('token_resolver')->defaultValue('server')->end()
				->append($this->buildServerSection())
			->end()
		;

		return $treeBuilder;
	}

	/**
	 * buildServerSection 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function buildServerSection()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('server');
		
		$rootNode
			->canBeDisabled()
			->addDefaultsIfNotSet()
			->children()
				->append($this->buildServerStorageSection())
				->append($this->buildServerGrantTypeSection())
				->append($this->buildServerResponseTypeSection())
				->arrayNode('configs')
					->defaultValue(array())
					->useAttributeAsKey('key')
					->prototype('variable')->end()
				->end()
			->end()
		;

		return $rootNode;
	}

	protected function buildServerStoragesSection()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('storages');

		$rootNode
			->children()
				->append($this->buildServerStrategicStorageSection('access_token'))
				->append($this->buildServerStrategicStorageSection('refresh_token'))
				->append($this->buildServerStrategicStorageSection('authorization_code'))
				->append($this->buildServerStrategicStorageSection('user_credentials'))
				->append($this->buildServerStrategicStorageSection('client'))
				->append($this->buildServerStrategicStorageSection('client_credentials'))
			->end()
		;

		return $rootNode;
	}


	protected function buildServerGrantTypeSection()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('grant_types');

		$rootNode
			->useAttributeAsKey('name')
			->prototype('array')
				->canBeDisabled()
				//->treatFalseLike(array('enabled' => false))
				//->treatTrueLike(array('enabled' => true))
				//->treatNullLike(array('enabled' => true))
				->beforeNormalization()
					->ifString()
					->then(function($v) {
						return array('enabled' => true, 'id' => $v);
					})
				->end()
				->children()
					//->scalarNode('enabled')->defaultTrue()->end()
					->scalarNode('id')->defaultNull()->end()
				->end()
			->end()
		;
		return $rootNode;
	}

	protected function buildServerResponseTypeSection()
	{
		$treeBuilder = new TreeBuilder();
		$rootNode = $treeBuilder->root('response_types');

		$rootNode
			->addDefaultsIfNotSet()
			->useAttributeAsKey('name')
			->prototype('scalar')->end()
			->end()
		;
		return $rootNode;
	}

//-----------------

	//protected function buildSecuritySection()
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root('security');

	//	$rootNode
	//		->canBeDisabled()
	//		->addDefaultsIfNotSet()
	//		->children()
	//			->append($this->buildSecurityTokenResolverSection())
	//			->append($this->buildSecurityUserinfoProviderSection())
	//		->end()
	//	;

	//	return $rootNode;
	//}

	//protected function buildSecurityTokenResolverSection()
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root('token_resolver');

	//	$rootNode
	//		->addDefaultsIfNotSet()
	//		->treatFalseLike(array('enabled' => false))
	//		->treatNullLike(array('enabled' => true))
	//		->children()
	//			->booleanNode('enabled')->defaultTrue()->end()
	//			->scalarNode('type')->defaultValue('server')->end()
	//			->scalarNode('base_url')->defaultNull()->end()
	//			->scalarNode('token_path')->defaultValue('/token')->end()
	//			->scalarNode('tokeninfo_path')->defaultValue('/tokeninfo')->end()
	//			->scalarNode('client_id')->defaultNull()->end()
	//			->scalarNode('client_secret')->defaultNull()->end()
	//			->scalarNode('cache')->defaultNull()->end()
	//		->end()
	//	;
	//	return $rootNode;
	//}

	//protected function buildSecurityUserinfoProviderSection()
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root('userinfo_provider');

	//	$rootNode
	//		->canBeEnabled()
	//		->addDefaultsIfNotSet()
	//		->children()
	//			->scalarNode('base_url')->defaultNull()->end()
	//			->scalarNode('path')->defaultValue('/userinfo')->end()
	//			->scalarNode('client_id')->defaultNull()->end()
	//			->scalarNode('client_secret')->defaultNull()->end()
	//			->scalarNode('cache')->defaultNull()->end()
	//		->end()
	//	;
	//	return $rootNode;
	//}

	//protected function buildTokenProviderSection()
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root('token_provider');

	//	$rootNode
	//		->treatFalseLike(array('enabled' => false))
	//		->treatTrueLike(array('enabled' => true))
	//		->treatNullLike(array('enabled' => true))
	//		->children()
	//			->booleanNode('enabled')
	//				->defaultFalse()
	//			->end()
	//			->arrayNode('supported_scopes')
	//				->treatNullLike(array())
	//				->beforeNormalization()
	//					->ifString()
	//					->then(function($v) {
	//						return array($v);
	//					})
	//				->end()
	//				->prototype('scalar')->end()
	//			->end()
	//			->arrayNode('default_scopes')
	//				->treatNullLike(array())
	//				->beforeNormalization()
	//					->ifString()
	//					->then(function($v) {
	//						return array($v);
	//					})
	//				->end()
	//				->prototype('scalar')->end()
	//			->end()
	//			->append($this->buildResponseTypesection())
	//			->append($this->buildServerSection())
	//			->append($this->buildStoragesSection())
	//			->append($this->buildGrantTypeSection())
	//		->end()
	//	;

	//	return $rootNode;
	//}

	//protected function buildServerSection()
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root('server');

	//	$rootNode
	//		->children()
	//			->booleanNode('enforce_state')->defaultFalse()->end()
	//		->end()
	//	;

	//	return $rootNode;
	//}

	//protected function buildStorageSection($name)
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root($name);

	//	$rootNode
	//		->canBeDisabled()
	//		->beforeNormalization()
	//			->ifString()
	//			->then(function($v){
	//				return array(
	//					'enabled' => true,
	//					'alias' => $v,
	//				);
	//			})
	//		->end()
	//		->children()
	//			->scalarNode('storage_class')->defaultNull()->end()
	//			->scalarNode('alias')->defaultNull()->end()
	//			->arrayNode('options')
	//				->defaultValue(array())
	//				->useAttributeAsKey('key')
	//				->prototype('variable')->end()
	//			->end()
	//		->end()
	//	;
	//	return $rootNode;
	//}

	//protected function buildStrategicStorageSection($name)
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root($name);

	//	$rootNode
	//		->canBeDisabled()
	//		->beforeNormalization()
	//			->ifString()
	//			->then(function($v){
	//				return array(
	//					'enabled' => true,
	//					'type' => 'alias',
	//					'connect_to' => $v,
	//				);
	//			})
	//		->end()
	//		->children()
	//			->booleanNode('use_strategy')->defaultTrue()->end()
	//			->scalarNode('type')->isRequired()->cannotBeEmpty()->end()
	//			->scalarNode('storage_class')->defaultNull()->end()
	//			->scalarNode('class')->end()
	//			->scalarNode('connect_to')->defaultNull()->end()
	//			->arrayNode('options')
	//				->defaultValue(array())
	//				->useAttributeAsKey('key')
	//				->prototype('variable')->end()
	//			->end()
	//		->end()
	//	;
	//	return $rootNode;
	//}

	//protected function buildResponseTypeSection()
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root('response_types');

	//	$rootNode
	//		->addDefaultsIfNotSet()
	//		->children()
	//			->scalarNode('token')->defaultValue('clio_oauth2_server.response_type.token.default')->end()
	//			->scalarNode('code')->defaultValue('clio_oauth2_server.response_type.code.default')->end()
	//		->end()
	//	;
	//	return $rootNode;
	//}

	//protected function buildGrantTypeSection()
	//{
	//	$treeBuilder = new TreeBuilder();
	//	$rootNode = $treeBuilder->root('grant_types');

	//	$rootNode
	//		->useAttributeAsKey('name')
	//		->prototype('array')
	//		->treatFalseLike(array('enabled' => false))
	//		->treatTrueLike(array('enabled' => true))
	//		->treatNullLike(array('enabled' => true))
	//		->beforeNormalization()
	//			->ifString()
	//			->then(function($v) {
	//				return array('enabled' => true, 'id' => $v);
	//			})
	//		->end()
	//		->children()
	//			->scalarNode('enabled')->defaultTrue()->end()
	//			->scalarNode('id')->defaultNull()->end()
	//		->end()
	//		//->children()
	//		//	->arrayNode('password')
    //        //        ->canBeDisabled()
	//		//		->children()
	//		//			->scalarNode('id')->defaultValue('clio_oauth2_server.grant_type.password')->end()
	//		//		->end()
    //        //    ->end()
	//		//	->arrayNode('client_credentials')
    //        //        ->canBeDisabled()
	//		//		->children()
	//		//			->scalarNode('id')->defaultValue('clio_oauth2_server.grant_type.client_credentials')->end()
	//		//		->end()
    //        //    ->end()
	//		//	->arrayNode('authorization_code')
    //        //        ->canBeDisabled()
	//		//		->children()
	//		//			->scalarNode('id')->defaultValue('clio_oauth2_server.grant_type.authorization_code')->end()
	//		//		->end()
    //        //    ->end()
	//		//	->arrayNode('refresh_token')
    //        //        ->canBeDisabled()
	//		//		->children()
	//		//			->scalarNode('id')->defaultValue('clio_oauth2_server.grant_type.refresh_token')->end()
	//		//		->end()
    //        //    ->end()
	//		//	->arrayNode('jwt_bearer')
    //        //        ->canBeDisabled()
	//		//		->children()
	//		//			->scalarNode('id')->defaultValue('clio_oauth2_server.grant_type.jwt_bearer')->end()
	//		//		->end()
    //        //    ->end()
	//		//	->arrayNode('chain')
    //        //        ->canBeDisabled()
	//		//		->children()
	//		//			->scalarNode('id')->defaultValue('clio_oauth2_server.grant_type.chain')->end()
	//		//		->end()
    //        //    ->end()
	//		//->end()
	//	;
	//	return $rootNode;
	//}
}

