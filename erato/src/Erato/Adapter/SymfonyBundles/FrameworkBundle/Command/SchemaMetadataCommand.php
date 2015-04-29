<?php
namespace Erato\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;

use Clio\Component\Metadata\Exception as MetadataException;

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

        $data = array();
		$fields = array();
		foreach($schema->getFields() as $field) {
			$mappings = array();
			foreach($field->getMappings() as $mapping) {
                $info = $this->getMappingInfo($mapping);
                if(null !== $info)
    				$mappings[$mapping->getName()]  = $info;
			}
			$fields[$field->getName()] = array(
				'type'    => $field->getTypeSchema()->getName(),
				'options' => $field->getOptions(),
				'mappings' => $mappings,
			);
		}
		$data['fields'] = $fields;

		$mappings = $schema->getMappings();
		if(0 < count($mappings)) {
			$mappingData = array();
			foreach($schema->getMappings() as $mapping) {
                $info = $this->getMappingInfo($mapping);
                if(null !== $info)
    				$mappingData[$mapping->getName()] = $info;
			}
			$data['mappings'] = $mappingData;
		} else {
			$data['mappings'] = array();
		}

		$output->writeln(Yaml::dump(array($schema->getName() => $data), 100));

		$this->getHelper('indent')->dedent();
		$this->getHelper('display')->horizontalBorder($output, '=');
	}

	protected function getMappingInfo($mapping)
	{
        try {
            $mapping->__getWrapped();
            return $mapping->getOptions();
        } catch(MetadataException\UnsupportedException $ex) {
            return null;
        }
	}
}

