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
			->setName('calliope:scheme:list')
			->setDefinition(array(
				new InputArgument('scheme', InputArgument::OPTIONAL, 'Target Schema'),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if($scheme = $input->getArgument('scheme')) {
			$this->displaySchemaDetail($output, $scheme);
		} else {
			$this->displaySchemaList($output);
		}
	}

	protected function displaySchemaDetail(OutputInterface $output, $schemeName)
	{
		$registry = $this->getSchemaRegistry();

		if($registry->hasAlias($schemeName)) {
			$manager = $registry->getSchemaManagerByAlias($schemeName);	
		} else if($registry->hasSchemaManager($schemeName)) {
			$manager = $registry->getSchemaManager($schemeName);
		}

		if($manager) {
			$scheme = array(
				'manager_class' => get_class($manager),
				'scheme_class' => $manager->getClassMetadata()->getName(),
				'connection_class' => get_class($manager->getConnection()),
			);
			$output->writeln(Yaml::dump($scheme));
		}
	}

	protected function displaySchemaList(OutputInterface $output)
	{
		$registry = $this->getSchemaRegistry();
		$schemes = array();
		foreach($registry as $alias => $manager) {
			$schemes[$alias] = array(
				'scheme_class' => $manager->getClassMetadata()->getName(),
			);
		}

		$output->writeln(Yaml::dump($schemes));
	}

	protected function getSchemaRegistry()
	{
		return $this->getContainer()->get('calliope_framework.scheme_manager_registry');
	}
}

