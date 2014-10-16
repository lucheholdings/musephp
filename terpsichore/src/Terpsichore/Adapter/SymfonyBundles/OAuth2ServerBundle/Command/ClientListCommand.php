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
 * ClientListCommand 
 * 
 * @uses Command
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientListCommand extends ContainerAwareCommand 
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
			->setName('oauth2:client:list')
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

		$clients = $clientManager->getClients();
		
		$table = $this->getHelper('table');
		$table
		    ->setHeaders(array('Name', 'ClientId', 'ClientSecret', 'Scope', 'GrantTypes'))
		;

		foreach($clients as $client) {
			$scopes = $client->getSupportedScopeStrings();
			$grants = $client->getAllowedGrantTypes();

			$table->addRow(array(
				$client->getName(),
				$client->getClientId(),
				$client->getClientSecret(),
				implode("\n", $scopes),
				implode("\n", $grants),
			));
		}
		$table->render($output);
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
}

