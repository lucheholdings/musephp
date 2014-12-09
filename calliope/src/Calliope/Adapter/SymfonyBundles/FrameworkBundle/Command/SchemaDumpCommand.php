<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;


class SchemaDumpCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('calliope:schema:dump')
			->setDescription('Dump data in schema')
			->setDefinition(array(
				new InputArgument('schema', InputArgument::REQUIRED, 'Target Schema'),
				new InputOption('offset', null, InputOption::VALUE_REQUIRED, 'Offset', 0),
				new InputOption('page', null, InputOption::VALUE_REQUIRED, 'Page Offset', 1),
				new InputOption('size', null, InputOption::VALUE_REQUIRED, 'Page Size', 10),
				new InputOption('profile', null, InputOption::VALUE_NONE, 'show execution time, memory usage.'),
				new InputOption('serializer', null, InputOption::VALUE_NONE, 'serialize result as json.'),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$schemaName = $input->getArgument('schema');
		$registry = $this->getSchemaRegistry();

		$size    = (int)$input->getOption('size');
		$offset  = (int)$input->getOption('offset');
		$page    = (int)$input->getOption('page');

		$offset = (($page - 1) * $size) + $offset;

		if($registry->has($schemaName)) {
			$manager = $registry->get($schemaName)->getMapping('schema_manager')->getManager();
		}

		if($manager) {
			$dump = $manager->findBy(array(), array(), $size, $offset);

			$data = $manager->normalize($dump, 'json');
			//$output->writeln(json_encode($dump, JSON_PRETTY_PRINT));

			if($input->getOption('serializer')) {
				$serializer = $this->getContainer()->get('jms_serializer');

				$output->writeln($serializer->serialize($data, 'json'));
			} else {
				$output->writeln(json_encode(($data), JSON_PRETTY_PRINT));
			}
		}

		if($input->getOption('profile') && $this->getHelper('profiler')) {
			$this->getHelper('profiler')->renderCurrentProfile($output);
		}
	}

	protected function getSchemaRegistry()
	{
		return $this->getContainer()->get('calliope_framework.metadata.registry');
	}
}

