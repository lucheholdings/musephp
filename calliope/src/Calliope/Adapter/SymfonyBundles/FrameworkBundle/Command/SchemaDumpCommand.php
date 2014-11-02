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
			->setName('calliope:scheme:dump')
			->setDefinition(array(
				new InputArgument('scheme', InputArgument::REQUIRED, 'Target Schema'),
				new InputOption('offset', null, InputOption::VALUE_REQUIRED, 'Offset', 0),
				new InputOption('page', null, InputOption::VALUE_REQUIRED, 'Page Offset', 1),
				new InputOption('size', null, InputOption::VALUE_REQUIRED, 'Page Size', 10),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$schemeName = $input->getArgument('scheme');
		$registry = $this->getSchemaRegistry();

		$size    = (int)$input->getOption('size');
		$offset  = (int)$input->getOption('offset');
		$page    = (int)$input->getOption('page');

		$offset = (($page - 1) * $size) + $offset;

		if($registry->hasAlias($schemeName)) {
			$manager = $registry->getSchemaManagerByAlias($schemeName);	
		} else if($registry->hasSchemaManager($schemeName)) {
			$manager = $registry->getSchemaManager($schemeName);
		}

		if($manager) {
			$dump = $manager->findBy(array(), array(), $size, $offset);
			// pre-load to avoid JMS Recursion
			$dump->load();

			$serializer = $this->getContainer()->get('jms_serializer');
			$serialized = $serializer->serialize($dump, 'json');
			$output->writeln(json_encode(json_decode($serialized), JSON_PRETTY_PRINT));
			//$output->writeln(json_encode($dump, JSON_PRETTY_PRINT));
		}
	}

	protected function getSchemaRegistry()
	{
		return $this->getContainer()->get('calliope_framework.scheme_manager_registry');
	}
}

