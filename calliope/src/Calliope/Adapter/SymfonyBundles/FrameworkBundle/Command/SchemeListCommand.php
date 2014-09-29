<?php
namespace Calliope\Adapter\SymfonyBundles\FrameworkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;


class SchemeListCommand extends ContainerAwareCommand 
{
	protected function configure()
	{
		$this
			->setName('calliope:scheme:list')
			->setDefinition(array(
				new InputArgument('scheme', InputArgument::OPTIONAL, 'Target Scheme'),
			))
			;
	}

	
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		if($scheme = $input->getArgument('scheme')) {
			$this->displaySchemeDetail($output, $scheme);
		} else {
			$this->displaySchemeList($output);
		}
	}

	protected function displaySchemeDetail(OutputInterface $output, $schemeName)
	{
		$registry = $this->getSchemeRegistry();

		if($registry->hasAlias($schemeName)) {
			$manager = $registry->getSchemeManagerByAlias($schemeName);	
		} else if($registry->hasSchemeManager($schemeName)) {
			$manager = $registry->getSchemeManager($schemeName);
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

	protected function displaySchemeList(OutputInterface $output)
	{
		$registry = $this->getSchemeRegistry();
		$schemes = array();
		foreach($registry as $alias => $manager) {
			$schemes[$alias] = array(
				'scheme_class' => $manager->getClassMetadata()->getName(),
			);
		}

		$output->writeln(Yaml::dump($schemes));
	}

	protected function getSchemeRegistry()
	{
		return $this->getContainer()->get('calliope_framework.scheme_manager_registry');
	}
}

