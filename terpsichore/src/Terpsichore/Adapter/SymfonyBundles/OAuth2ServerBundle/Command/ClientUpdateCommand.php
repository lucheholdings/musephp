<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ClientManagerInterface;
use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ScopeManagerInterface;
/**
 * ClientUpdateCommand 
 * 
 * @uses Command
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientUpdateCommand extends ContainerAwareCommand 
{
	/**
	 * configure 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function configure()
	{
		$this
			->setName('oauth2:client:update')
			->addArgument('name', InputArgument::REQUIRED, 'Client name')
			->addOption('scope', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Supported Scope(s)')
			->addOption('grant', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Supported GrantType(s)')
			->addOption('uri', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Supported Redirect Uri(s)')
			->addOption('create-scopes', null, InputOption::VALUE_NONE, 'Create scopes if not exists.')
		;
	}

	/**
	 * execute 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		// 
		$clientManager = $this->getClientManager();

		if($clientManager) {
			$client = $clientManager->getClientByName($input->getArgument('name'));

			if($input->getOption('grant')) {
				$client->setAllowedGrantTypes($input->getOption('grant'));
			}

			if($input->getOption('uri')) {
				$client->setRedirectUris($input->getOption('uri'));
			}
			
			if($input->getOption('scope')) {
				$scopes = $this->loadScopes($input->getOption('scope', array()), $input->getOption('create-scopes'));
				$client->setScopes($scopes);
			}
			$clientManager->save($client);
		} else {
			throw new \RuntimeException('This oauth2 server is not ClientProvider.');
		}
	}

	protected function loadScopes(array $scopes, $autoCreate = false)
	{
		$scopeProvider = $this->getScopeProvider();
		$models = $scopeProvider->getScopes($scopes);

		if($autoCreate && ($scopeProvider instanceof ScopeManagerInterface)) {
			$newScopes = array_filter($scopes, function($scope) use ($models) {
				foreach($models as $model) {
					if($scope == $model->getScope()) {
						return false;
					}
				}
				return true;
			});

			if(!empty($newScopes)) {
				foreach($newScopes as $newScope) {
					$newModel = $scopeProvider->createScope();
					$newModel
						->setScope($newScope)
					;
					$scopeProvider->save($newModel, false);
				}
				$scopeProvider->flush();
			}

			// Reload Scopes
			$models = $scopeProvider->getScopes($scopes);
		}

		return $models;
	}


	/**
	 * getClientManager 
	 * 
	 * @access public
	 * @return void
	 */
	protected function getClientManager()
	{
		$manager = $this->getContainer()->get('terpsichore_oauth2_server.storage_strategy.client');

		if(!$manager instanceof ClientManagerInterface) {
			throw new \RuntimeException('Client StorageStrategy is not a ClientManager.');
		}

		return $manager;
	}

	protected function getScopeProvider()
	{
		$manager = $this->getContainer()->get('terpsichore_oauth2_server.storage_strategy.scope');

		return $manager;
	}
}

