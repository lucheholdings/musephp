<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Command;

/**
 * ClientCreateCommand 
 * 
 * @uses Command
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ClientCreateCommand extends Command 
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
			->setName('terpsichore:oauth2:client:create')
			->addArgument('name', InputArgument::REQUIRED, 'Client name')
			->addOption('scope', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Supported Scope(s)')
			->addOption('grant', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Supported GrantType(s)')
			->addOption('uri', null, InputOption::VALUE_IS_ARRAY | InputOption::VALUE_REQUIRED, 'Supported Redirect Uri(s)')
		;
	}

	/**
	 * execute 
	 * 
	 * @access protected
	 * @return void
	 */
	protected function execute()
	{
		// 
		$clientManager = $this->getClientManager();

		if($clientManager) {
			$name = $input->getArgument('name');
			$scopes = $input->getArgument('scope');
			$grants = $input->getArgument('grant');
			$uris   = $input->getArgument('uri');

			$client = $clientManager->createClient($name, $scopes, $grants, $uris);

			$clientManager->save($client);
		} else {
			throw new \RuntimeException('This oauth2 server is not ClientProvider.');
		}
	}

	/**
	 * getClientManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getClientManager()
	{
		$manager = $this->get('terpsichore_oauth2_server.storage_strategy.client')

		if(!$manager instanceof ClientManagerInterface) {
			throw new \RuntimeException('Client StorageStrategy is not a ClientManager.');
		}

		return $manager;
	}
}

