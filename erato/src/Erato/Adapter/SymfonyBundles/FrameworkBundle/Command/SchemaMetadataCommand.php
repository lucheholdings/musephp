<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * SchemaMetadataCommand 
 * 
 * @uses ContainerAwareCommand
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class SchemaMetadataCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('erato:schema:metadata')
			->setDefinition(array(
				new InputArgument('schema', InputArgument::REQUIRED, 'Target Schema'),
				new InputOption('with-mapping', null, InputOption::VALUE_NONE, 'Show mapping detail'),
				// 
				new InputOption('profile', null, InputOption::VALUE_NONE, 'show execution time, memory usage.'),
			))
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$schema = $input->getArgument('schema');

		$this->displaySchemaDetail($schema, $output);


		if($input->getOption('profile') && $this->getHelper('profiler')) {
			$this->getHelper('profiler')->renderCurrentProfile($output);
		}
	}

	protected function displaySchemaDetail($schema, OutputInterface $output)
	{
		$output = $this->getHelper('indent')->decorate($output);

		$schemaRegistry = $this->getContainer()->get('erato_framework.schema.registry');

		if(!$schemaRegistry->has($schema)) {
			$output->writeln(sprintf('<error>Schema "%s" is not exists.</error>', $schema));
			return;
		}
		
		$this->getHelper('display')->horizontalBorder($output, '=');
		$this->getHelper('indent')->indent();
		$this->getHelper('display')->newline($output);

		$schema = $schemaRegistry->get($schema);

		$data = array(
			'SchemaName' => $schema->getName(),
		);

		$fields = array();
		foreach($schema->getFields() as $field) {
			$mappings = array();
			foreach($field->getMappings() as $mapping) {
				$mappings[$mapping->getName()] = $this->getMappingInfo($mapping);
			}
			$fields[$field->getName()] = array(
				'type'    => $field->getType()->getName(),
				'Mapping' => $mappings,
			);
		}
		$data['Fields'] = $fields;

		$mappings = $schema->getMappings();
		if(0 < count($mappings)) {
			$mappingData = array();
			foreach($schema->getMappings() as $mapping) {
				$mappingData[$mapping->getName()] = $this->getMappingInfo($mapping);
			}
			$data['Mappings'] = $mappingData;
		} else {
			$data['Mappings'] = 'N/A';
		}

		$output->writeln(Yaml::dump($data, 100));

		$this->getHelper('indent')->dedent();
		$this->getHelper('display')->horizontalBorder($output, '=');

	}

	protected function getMappingInfo($mapping)
	{
		if(method_exists($mapping, 'dumpConfig')) {
			return $mapping->dumpConfig();
		}
		return array();
	}
}

