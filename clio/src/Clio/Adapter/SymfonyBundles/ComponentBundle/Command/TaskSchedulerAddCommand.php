<?php
namespace Clio\Adapter\SymfonyBundles\ComponentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

use Clio\Component\Util\Task\Task\Task;

/**
 * TaskSchedulerAddCommand 
 * 
 * @uses ContainerAwareCommand
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TaskSchedulerAddCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('clio:task:scheduler:add')
			->setDescription('Add task into the Scheduler.')
			->setDefinition(array(
				new InputArgument('name', InputArgument::REQUIRED, 'Task name'),
				new InputArgument('args', InputArgument::OPTIONAL, 'Arguments in json', array()),
				new InputOption('scheduler', null, InputOption::VALUE_REQUIRED, 'Target scheduler', null),
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

		$type = $input->getOption('scheduler');

		$scheduler = $taskManager->getScheduler($type);

	
		$args = $input->getArgument('args');
		if(is_string($args)) {
			$args = json_decode($args, true);
		}

		$task = new Task($input->getArgument('name'), $args);
		$scheduler->scheduleTask($task);

		if($scheduler instanceof \Countable) {
			$output->writeln(sprintf('Remained Tasks : %d', count($scheduler)));
		}
	}
}

