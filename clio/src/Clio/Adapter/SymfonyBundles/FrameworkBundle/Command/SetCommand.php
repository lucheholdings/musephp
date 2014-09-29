<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;


class SetCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('clio:kvs:set')
			->setDefinition(array(
				new InputArgument('table', InputArgument::REQUIRED, 'table'),
				new InputArgument('key', InputArgument::REQUIRED, 'key'),
				new InputArgument('value', InputArgument::REQUIRED, 'value'),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		// 
		$table = $input->getArgument('table');
		$key = $input->getArgument('key');
		$value = $input->getArgument('value');

		// 
		$kvs = $this->getKvs($table);

		$kvs->set($key, $value);
		$output->writeln(sprintf('%s    :   %s', $key, $kvs->get($key)));
	}

	public function getKvs($table)
	{
		return $this->getContainer()->get('clio_framework.kvs_registry')->get($table);
	}
}

