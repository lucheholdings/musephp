<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Command;

class ClientCreateCommand extends Command 
{
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
}

