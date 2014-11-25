<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * SchemaDumpCommand 
 * 
 * @uses ContainerAwareCommand
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaDumpCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('erato:schema:dump')
			->setDefinition(array(
				new InputArgument('schema', InputArgument::REQUIRED, 'Target Schema'),
			))
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$schema = $input->getArgument('schema');

		$this->displaySchemaDetail($schema, $output);
	}

	protected function displaySchemaDetail($schema, OutputInterface $output)
	{
		$schemaRegistry = $this->getContainer()->get('erato_framework.metadata.registry');

		if(!$schemaRegistry->has($schema)) {
			$output->writeln(sprintf('<error>Schema "%s" is not exists.</error>', $schema));
			return;
		}

		$schema = $schemaRegistry->get($schema);
		
		$table = $this->getHelper('table');

		$table->addRow(array('SchemaName', $schema->getName()));

		$table->render($output);
	}
}

