<?php
namespace Clio\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;


class GetCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('clio:kvs:get')
			->setDefinition(array(
				new InputArgument('table', InputArgument::REQUIRED, 'table'),
				new InputArgument('key', InputArgument::OPTIONAL, 'key'),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		// 
		$table = $input->getArgument('table');
		$key = $input->getArgument('key');

		// 
		$kvs = $this->getKvs($table);

		if($key) {
			if(false === $kvs->hasKey($key)) {
				throw new \RuntimeException(sprintf('Key "%s" is not existed.', $key));
			}

			$output->writeln(sprintf('%s    :   %s', $key, $kvs->get($key)));
		} else {
			foreach($kvs->getKeyValueArray() as $key => $value) {
				$output->writeln(sprintf('%s    :   %s', $key, $value));
			}
		}
	}

	public function getKvs($table)
	{
		return $this->getContainer()->get('clio_framework.kvs_registry')->get($table);
	}
}

