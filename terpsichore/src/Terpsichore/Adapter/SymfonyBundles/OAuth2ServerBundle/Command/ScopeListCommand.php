<?php
namespace Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Terpsichore\Adapter\SymfonyBundles\OAuth2ServerBundle\Model\ScopeManagerInterface;
/**
 * ScopeListCommand 
 * 
 * @uses Command
 * @package { PACKAGE }
 * @copyright { COPYRIGHT } (c) { COMPANY }
 * @author Yoshi Aoki <yoshi@44services.jp> 
 * @license { LICENSE }
 */
class ScopeListCommand extends ContainerAwareCommand 
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
			->setName('oauth2:scope:list')
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

		$scopes = $scopeManager->getScopes();

		$table = $this->getHelper('table');
		$table
		    ->setHeaders(array('Scope'))
		;

		foreach($scopes as $scope) {
			$table->addRow(array(
				$scope->getScope()
			));
		}
		$table->render($output);

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

