<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;


class SchemaListCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('calliope:schema:list')
			->setDescription('List all calliope schemas')
			->setDefinition(array(
				new InputArgument('schema', InputArgument::OPTIONAL, 'Pick one Schema to show more detail'),
				new InputOption('profile', null, InputOption::VALUE_NONE, 'show execution time, memory usage.'),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if($schema = $input->getArgument('schema')) {
			$this->displaySchemaDetail($output, $schema);
		} else {
			$this->displaySchemaList($output);
		}

		if($input->getOption('profile') && $this->getHelper('profiler')) {
			$this->getHelper('profiler')->renderCurrentProfile($output);
		}
	}

	protected function displaySchemaDetail(OutputInterface $output, $schemaName)
	{
		$registry = $this->getSchemaRegistry();


		if($registry->has($schemaName)) {
			$metadata = $registry->get($schemaName);
			if($metadata) {
				
				$manager =  $metadata->getManager();
				$schema = array(
					'manager_class' => get_class($manager),
					'schema_class'  => $metadata->getParent()->getName(),
					'connection_class' => get_class($manager->getConnection()),
				);
				$output->writeln(Yaml::dump($schema));
			}
		}
	}

	protected function displaySchemaList(OutputInterface $output)
	{
		$registry = $this->getSchemaRegistry();
		$schemas = array();

		$tableHelper = $this->getHelper('table');

		$tableHelper->setHeaders(array('name', 'schema_class', 'connection', 'connect_to'));
		foreach($registry as $name => $schema) {
			if($registry->hasAlias($name)) {
				$tableHelper->addRow(array($name, $schema->getParent()->getName() , 'Alias', $registry->getAlias($name)));
			} else {
				$tableHelper->addRow(array($schema->getName(), $schema->getParent()->getName(), get_class($schema->getMapping('schema_manager')->getManager()->getConnection()), $schema->getMapping('schema_manager')->getManager()->getConnection()->getConnectToName()));
			}
		}

		$tableHelper->render($output);
	}

	protected function getSchemaRegistry()
	{
		return $this->getContainer()->get('calliope_framework.schema.registry');
	}
}

