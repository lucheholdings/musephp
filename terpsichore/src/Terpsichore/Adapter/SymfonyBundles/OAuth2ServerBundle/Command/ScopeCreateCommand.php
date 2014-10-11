<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ScopeManagerInterface;
/**
 * ScopeCreateCommand 
 * 
 * @uses Command
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ScopeCreateCommand extends ContainerAwareCommand 
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
			->setName('oauth2:scope:create')
			->addArgument('scope', InputArgument::REQUIRED, 'Scope')
			->addOption('is_default', null, InputOption::VALUE_NONE, 'Flag as default')
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
		$scopeManager = $this->getScopeManager();
		$scopeStr = $input->getArgument('scope');

		// First try to load the scope
		$scope = $scopeManager->getScope($scopeStr);
		if(!$scope) {
			$scope = $scopeManager->createScope();
		}
		$scope
			->setScope($scopeStr)
		;
		if($input->getOption('is_default')) {
			$scope->enableDefault();
		} else {
			$scope->disableDefault();
		}

		$scopeManager->save($scope);
	}

	/**
	 * getScopeManager 
	 * 
	 * @access public
	 * @return void
	 */
	public function getScopeManager()
	{
		$manager = $this->getContainer()->get('terpsichore_oauth2_server.storage_strategy.scope');

		if(!$manager instanceof ScopeManagerInterface) {
			throw new \RuntimeException('Scope StorageStrategy is not a ScopeManager.');
		}

		return $manager;
	}
}

