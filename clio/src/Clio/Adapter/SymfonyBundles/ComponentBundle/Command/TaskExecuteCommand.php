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
 * TaskExecuteCommand 
 * 
 * @uses ContainerAwareCommand
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TaskExecuteCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('clio:task:execute')
			->setDescription('Execute task with name and args.')
			->setDefinition(array(
				new InputArgument('name', InputArgument::REQUIRED, 'Task name'),
				new InputArgument('args', null, InputArgument::OPTIONAL, 'Arguments in json', array()),
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

		$args = $input->getArgument('args');
		if(is_string($args)) {
			$args = json_decode($args, true);
		}

		$task = new Task($input->getArgument('name'), $args);

		if($input->getOption('verbose')) {
			$output->writeln('TASK BEGIN (Only Command Task will be output)-----------------------------------------------------');

			foreach($taskManager->getExecutors() as $executor) {
				if($executor instanceof \Clio\Bridge\SymfonyComponents\Task\Executor\CommandExecutor) {
					$executor->setOutput($output);
				}
			}
		}
		$taskManager->execute($task);

		if($input->getOption('verbose')) {
			$output->writeln('TASK END   -----------------------------------------------------');
		}
		if($task->isSuccessed()) {
			$output->writeln('Complete task with success.');

		} else {
			$output->writeln('Failed on task execution.');

			throw $task->getError();
		}
	}
}

