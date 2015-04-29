<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

use Clio\Component\Task\Task\Task;

/**
 * TaskSchedulerStatusCommand 
 * 
 * @uses ContainerAwareCommand
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TaskSchedulerStatusCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('clio:task:scheduler:status')
			->setDescription('Show status of the Scheduler.')
			->setDefinition(array(
				new InputArgument('name', InputArgument::REQUIRED, 'Scheduler name'),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		try {
			$taskManager = $this->getContainer()->get('clio_component.task_manager');
		} catch(\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException $ex) {
			throw new \RuntimeException('Please enable "task" on "clio_component" at config.yml.', 0, $ex);
		}

		if(!$taskManager) {
			throw new \RuntimeException('TaskManager is not exists.');
		}

		$scheduler = $taskManager->getScheduler($input->getArgument('name'));

		if($scheduler instanceof \Countable) {
			$output->writeln(sprintf('Remained Tasks : %d', count($scheduler)));
		}
	}
}

