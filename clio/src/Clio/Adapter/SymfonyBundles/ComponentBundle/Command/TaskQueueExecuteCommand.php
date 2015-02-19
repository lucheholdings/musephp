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
 * TaskQueueExecuteCommand 
 * 
 * @uses ContainerAwareCommand
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class TaskQueueExecuteCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('clio:task:scheduler:execute')
			->setDescription('Execute task in Scheduler.')
			->setDefinition(array(
				new InputArgument('name', InputArgument::REQUIRED, 'Scheduler name'),
				new InputOption('max', null, InputOption::VALUE_REQUIRED, 'Max number to execute task. 0 for all.', 1),
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

		$max = $input->getOption('max');

		$countExecuted = 0;
		try {
			for(; $max == 0;) {
				$scheduler->run();
				$countExecuted++;

				if($max >= 0) {
					$max--;
				}
			}
		} catch(EmptyException $ex) {
			break;
		}

		$output->writeln(sprintf('Executed Tasks : %d', $countExecuted));
	}
}

